<?php namespace Observatby\FileSharingOnCdn\Models;

use Model;
use Barantaran\Platformcraft\Platform;
use October\Rain\Support\Facades\Config;

/**
 * Link Model
 */
class Link extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'observatby_filesharingoncdn_links';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'description'
    ];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'description' => 'required',
        'file' => 'required',
    ];

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    /**
     * @var array Attributes that support translation, if available.
     */
    public $translatable = [
        'description'
    ];


    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

//    /**
//     * @var array Relations
//     */
//    public $hasOne = [];
//    public $hasMany = [];
//    public $hasOneThrough = [];
//    public $hasManyThrough = [];
//    public $belongsTo = [];
//    public $belongsToMany = [];
//    public $morphTo = [];
//    public $morphOne = [];
//    public $morphMany = [];
//    public $attachOne = [];
//    public $attachMany = [];

    public $attachOne = [
        'file' => ['System\Models\File', 'public' => false],
    ];


    protected function afterCreate()
    {
        parent::afterCreate();
        # TODO $this->file is null always
        if ($this->addToCdn($this->getPlatformcraftClient())) {
            $this->save();
        }
    }

    protected function beforeDelete()
    {
        $this->deleteFromCdn($this->getPlatformcraftClient());
        $this->file->delete();
        parent::beforeDelete();
    }


    private function getPlatformcraftClient(): Platform
    {
        return new Platform(
            Config::get('observatby.filesharingoncdn::platformcraft.api_user_id'),
            Config::get('observatby.filesharingoncdn::platformcraft.hmac_key')
        );
    }

    private function addToCdn(Platform $platform): bool
    {
        if ($this->file !== null) {
            $fileUploadResult = $platform->addFile($this->file->getLocalPath());
            if ($fileUploadResult) {
                $this->cdn_id = $fileUploadResult['id'];
                $this->cdn_name = $fileUploadResult['name'];
                $this->cdn_url = $fileUploadResult['cdn_url'];
                return true;
            }
        }

        return false;
    }

    private function deleteFromCdn(Platform $platform): bool
    {
        $deleteResponse = $platform->deleteObject($this->cdn_id);
        if ($deleteResponse) {
            $this->cdn_id = null;
            $this->cdn_name = null;
            $this->cdn_url = null;
            return true;
        }

        return false;
    }
}
