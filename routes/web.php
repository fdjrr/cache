<?php

use App\Models\Article;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  $seconds = 120;

  $articles = Cache::remember('articles', $seconds, function () {
    $articles = Article::with('user', 'category')->limit(1000)->get();
    return $articles;
  });

  return view('articles.index', [
    'articles' => $articles,
  ]);
})->name('articles.index');

Route::get('/{slug}', function (string $slug) {
  $seconds = 120;

  $article = Cache::remember('article:' . $slug, $seconds, function () use ($slug) {
    $article = Article::with('user', 'category')->where('slug', $slug)->first();
    return $article;
  });

  return view('articles.show', [
    'article' => $article,
  ]);
})->name('articles.show');

Route::prefix('cache')->group(function () {
  Route::get('/', function () {
    $articles = Cache::get('articles');

    return view('articles.index', [
      'articles' => $articles,
    ]);
  });

  Route::get('/put', function () {
    $seconds = 120;

    $articles = Article::with('user', 'category')->limit(1000)->get();
    Cache::put('articles', $articles, $seconds);

    return "Articles cached for $seconds seconds";
  });

  Route::get('/remember', function () {
    $seconds = 120;

    $articles = Cache::remember('articles', $seconds, function () {
      $articles = Article::with('user', 'category')->limit(1000)->get();
      return $articles;
    });

    return view('articles.index', [
      'articles' => $articles,
    ]);
  });
});

Route::get('/benchmark', function () {
  return Benchmark::dd([
    'db'    => fn()    => Article::with('user', 'category')->limit(1000)->get(),
    'cache' => fn() => Cache::get('articles'),
  ], 5);
});
