public function test_usuario_se_crea_correctamente()
{
    $response = $this->post(route('usuarios.store'), [
        'Nombre' => 'Juan Pérez',
        'email' => 'juan@example.com',
        'password' => 'password123',
    ]);

    $response->assertRedirect(route('usuarios.index'));
    $this->assertDatabaseHas('usuarios', ['email' => 'juan@example.com']);
}