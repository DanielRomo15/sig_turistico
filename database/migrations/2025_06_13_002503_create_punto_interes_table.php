

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('punto_interes', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->text('descripcion');
        $table->string('categoria');
        $table->string('imagen')->nullable();
        $table->decimal('latitud', 10, 7);
        $table->decimal('longitud', 10, 7);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('punto_interes');
    }
};
