<?php namespace Observatby\FileSharingOnCdn\Models;

use Model;

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
    public $rules = [];

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
}
