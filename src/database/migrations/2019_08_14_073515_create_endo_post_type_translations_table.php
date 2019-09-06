<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEndoPostTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endo_post_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('endo_post_type_id')->unsigned();
            $table->string('url_name')->nullable();
            $table->string('title');
            $table->string('title_plural');
            $table->string('locale')->nullable()->index();
            $table->timestamps();

            $table->unique(['url_name', 'locale']);
        });

        $postTypes = \Endo\EndoCore\App\Models\EndoPostType::all();
        $locales = \Endo\EndoCore\App\Models\EndoLanguage::all();

        foreach ($postTypes as $postType) {
            foreach ($locales as $locale) {
                DB::table('endo_post_type_translations')->insert([
                    'endo_post_type_id' => $postType->id,
                    'url_name' => __($postType->name, [], $locale->code),
                    'title' => __(ucfirst($postType->name), [], $locale->code),
                    'title_plural' => __(ucfirst($postType->name) . 's', [], $locale->code),
                    'locale' => $locale->code
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endo_post_type_translations');
    }
}
