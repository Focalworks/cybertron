<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FileManagedTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('files_managed');
        
        Schema::create('files_managed', function ($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('file_id'); // the primary file id
            $table->integer('user_id'); // user who uploaded the file
            $table->string('file_name'); // the sanitized file name
            $table->string('file_url'); // the url where the file is located
            $table->string('file_mime'); // the mime type of the file uploaded
            $table->integer('file_size'); // the file size in bytes
            $table->integer('file_status'); // the status of the file - 0 (temp file which should be deleted on cron) : 1 (permanent file will not be deleted)
            $table->timestamp('added_on'); // time when the file was uploaded
            $table->string('file_type'); // the type of file
            $table->string('entity_type'); // the entity to which the file is associated with
        });
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::dropIfExists('files_managed');
	}

}
