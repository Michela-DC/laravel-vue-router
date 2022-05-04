<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignCategoryPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Whenever we write an unsigned to any column that means you cannot insert negative numbers
            $table->unsignedBigInteger('category_id')->nullable()->after('slug'); //con after specifico che sarà messo dopo la colonna dello slug
            // se aggiungo un campo ad una tabella che ha già dei dati, allora nel campo aggiunto i dati non avranno valori, quindi posso dire che quel dato può essere nullo oppure potrei assegnare un valore di default 
        
            //add foreign key che serve per creare una relazione con un'altra tabella
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')->onDelete('set null'); //ogni volta che una categoria viene eliminata il valore viene messo nullo
            //quindi la foreign key, chiamata category_id, si riferisce all'id della tabella categories
            //non è obbligatorio mettere l'on delete, dipende dai casi, di default è restrict 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {

            //drop foreign key ci sono deu modi per farlo:
            // - o passando una stringa con la nomenclatura, che viene creata di default da laravel, della foreign key = nome tabella_nome chiave esterna_foreig
            // $table->dropForeign('posts_category_id_foreign');
            // - oppure passando un array con dentro il nome della colonna
            $table->dropForeign(['category_id']);

            //drop column
            $table->dropColumn('category_id');

        });
    }
}
