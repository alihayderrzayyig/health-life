<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\File;


class Post extends Model
{
    use HasFactory, HasSlug;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];


    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function deletePost()
    {
        $images = $this->images()->get();
        foreach ($images as $am) {
            if (file_exists('post_images/' . $am->image)) {
                File::delete('post_images/' . $am->image);
            }
            if ($am) {
                $am->delete();
            }
        }

        $this->delete();
    }

    public function deletePostImages()
    {
        $images = $this->images()->get();
        foreach ($images as $am) {
            // echo $am->image . '<br>';
            if (file_exists('post_images/' . $am->image)) {
                File::delete('post_images/' . $am->image);
            }
            if ($am) {
                $am->delete();
            }
        }
    }
}
