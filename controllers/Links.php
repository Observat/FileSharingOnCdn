<?php namespace Observatby\FileSharingOnCdn\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;
use Barantaran\Platformcraft\Platform;
use Illuminate\Support\Facades\Redirect;
use Observatby\FileSharingOnCdn\Models\Link;
use October\Rain\Support\Facades\Config;
use System\Models\File;

/**
 * Links Back-end Controller
 */
class Links extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Observatby.FileSharingOnCdn', 'filesharingoncdn', 'links');
    }

    public function create_onSave(...$argSave)
    {
        $response = parent::create_onSave(...$argSave);

        $links = Link::where('created_at', '>=', (new \DateTimeImmutable("now - 30 seconds"))->format(\DateTimeInterface::ISO8601))->get();
        foreach ($links as $link) {
            $link->sendToCdnAfterCreate();
        }

        return $response;
    }

    public function update_onSave(...$argSave)
    {
        $linkId = $argSave[0];
        $modelBefore = Link::find($linkId);
        $fileBefore = $modelBefore->file;

        $response = parent::update_onSave(...$argSave);

        $modelAfter = Link::find($linkId);
        $fileAfter = $modelAfter->file;

        if ($fileAfter->id !== $fileBefore->id) {
            $this->updateCdn($modelAfter, $fileAfter);
        }

        return $response ?: Redirect::refresh();
    }

    # TODO Parts duplicated in model Link
    private function updateCdn(Link $model, ?File $newFile)
    {
        $platform = new Platform(
            Config::get('observatby.filesharingoncdn::platformcraft.api_user_id'),
            Config::get('observatby.filesharingoncdn::platformcraft.hmac_key')
        );

        $deleteResponse = $platform->deleteObject($model->cdn_id);
        if ($deleteResponse) {
            $model->cdn_id = null;
            $model->cdn_url = null;
            $model->save();
        }

        if ($newFile !== null) {
            $fileUploadResult = $platform->addFile($newFile->getLocalPath());
            if ($fileUploadResult) {
                $model->cdn_id = $fileUploadResult['id'];
                $model->cdn_url = $fileUploadResult['cdn_url'];
                $model->save();
            }
        }
    }
}
