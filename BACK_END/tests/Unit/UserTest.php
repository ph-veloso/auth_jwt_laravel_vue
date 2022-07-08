<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /** @test  */
    public function check_if_user_columns_is_correct()
    {
        $user = new User();

        $expected = [
            'nome',
            'email',
            'password',
            'cpf',
            'pis',
            'pais',
            'cep',
            'estado',
            'cidade',
            'bairro',
            'rua',
            'numero',
            'complemento',
        ];
        $arrayCompared = array_diff($expected, $user->getFillable());
        $this->assertEquals(0, count($arrayCompared));
    }
}
