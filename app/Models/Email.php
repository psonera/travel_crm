<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes, Prunable;

    protected $dates = [ 'deleted_at' ];
    
    protected $fillable = ['to', 'from', 'cc', 'bcc','subject', 'content','status'];

    protected $searchableFields = ['*'];

    protected $table = 'mails';

    public const INBOX = 1;
    public const SENT = 2;
    public const DRAFT = 3;
    public const  TRASH = 4;
    public const OUTBOX = 5;

    const STATUS = [
        self::INBOX => 'Inbox',
        self::SENT => 'Sent',
        self::DRAFT => 'Draft',
        self::TRASH => 'Trash',
        self::OUTBOX => 'Outbox',
    ];

    public function template()
    {
        return $this->hasOne(EmailTemplate::class);
    }
}
