<?php

namespace App\Data\Models;

use App\Traits\Attachable as AttachableTrait;
use App\Traits\SnowflakeID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use AttachableTrait, SnowflakeID;

    protected $fillable = [
        'file_name',
        'title',
        'description',
        'field',
        'attachable_id',
        'attachable_type',
        'is_public',
        'sort_order',
        'data',
    ];

    protected $guarded = [];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    protected $hidden = ['attachable_type', 'attachable_id', 'is_public'];

    public function attachable()
    {
        return $this->morphTo();
    }

    /**
     * Problem - Imagine we are fetching list of users with the appended values (profile_picture) which trigger a sql call to each user, the workload on database will be too much, and it's not worth.
     * To avoid this problem, we can simply use the following helper function
     *
     * Remove your appends to file model in your model firstly,
     *
     * $users = User::leftJoin("files", function (Illuminate\Database\Query\JoinClause $query) {
     *       $query->on("users.id", "files.attachable_id")->where("files.field", "profile_picture");
     *   })->get()->map(function (User $user) {
     *       $user->profile_picture_object = $user->disk_name ? App\Data\Models\File::getInstance($user->disk_name) : null;
     *       return $user;
     *   });
     *
     * dd($users->first()->profile_picture_object) will produce the following data
     *
     *  App\Data\Models\File {#6042
     *      disk_name: "63f8468f17ba6847078531",
     *      +url: "https://yla.s3.ap-southeast-1.amazonaws.com/local/public/63f/846/8f1/63f8468f17ba6847078531",
     *      +path: "/local/public/63f/846/8f1/63f8468f17ba6847078531",
     *      +extension: "",
     * }
     *
     *
     **/
    public static function getInstance($diskName): File
    {
        $file = new File();
        $file->disk_name = $diskName;

        return $file;
    }
}
