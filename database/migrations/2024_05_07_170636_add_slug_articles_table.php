<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Article;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('articles',function(Blueprint $table){
            $table->string('slug')->after('title')->nullable()->unique();
        });
        foreach(Article::all() as $article){
          $article->slug=Str::slug($article->title);//slug converte tutta la stringa in minuscolo convertendo i caratteri speciali in -at- e togliendo gli spazi iniziali e finali,poi tutti i - consecutivi vengono ridotti ad un singolo _
          $article->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles',function(Blueprint $table){
            $table->dropColumn('slug');
        });
    }
};
