public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('username')->unique()->after('id');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('username');
    });
}
