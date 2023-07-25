<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Post extends Model implements Feedable
{
    use HasFactory;
    protected $guarded = ['id'];

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->content)
            ->updated($this->updated_at)
            ->link('https://smartcity.palopokota.go.id/home/news')
            ->author($this->user->name);
    }

    public static function getPostItem()
    {
        return Post::all();
    }

    public function visibilities()
    {
        return $this->belongsToMany(Visibilitie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategorie::class, 'subcategorie_id');
    }

    public function post_visibility()
    {
        return $this->belongsTo(PostVisibilitie::class, 'post_id')->orderBy('id', 'desc');
    }

    public static function getType($key, $default = null)
    {
        $post_video = self::where('type', $key)->first();

        if (isset($post_video)) {
            return $post_video;
        } else {
            return $default;
        }
    }

    public static function getCategory($key, $default = null)
    {
        $postCategory = self::where('categorie_id', $key)->orderBy('id', 'desc')->skip(0)->take(4)->get();

        if (isset($postCategory)) {
            return $postCategory;
        } else {
            return $default;
        }
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['user'] ?? false, function ($query, $user) {
            return $query->whereHas('user', function ($query) use ($user) {
                $query->where('name', $user);
            });
        });
    }
}
