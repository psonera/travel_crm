<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $dates = [ 'deleted_at' ];
    
    protected $fillable = ['to', 'from', 'cc', 'bcc','subject', 'content','status'];

    protected $searchableFields = ['*'];

    protected $table = 'mails';

    public const SENT = 1;
    public const DRAFT = 2;
    public const  TRASH = 3;

    const STATUS = [
        self::SENT => 'Sent',
        self::DRAFT => 'Draft',
        self::TRASH => 'Trash',
    ];

    public function template()
    {
        return $this->hasOne(EmailTemplate::class);
    }
}
