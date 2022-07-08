<template>
  <h1 id="tituloCadastro">Cadastro</h1>
  <div class="container">
    <main class="form-edit w-100 m-auto">
      <form @submit.stop.prevent="submit">
        <div class="row">
          <label class="form-label fw-bold fs-5">INFORMAÇÕES PESSOAIS</label>

          <div class="form-floating col-lg-6">
            <input
              v-model="data.nome"
              type="text"
              class="form-control"
              id="entrarNome"
              name="nome"
              placeholder="nome"
              required
            />
            <label for="entrarNome"> Nome: </label>
          </div>
          <div class="form-floating col-lg-6">
            <input
              v-model="data.email"
              :old-value="data.email"
              type="email"
              class="form-control"
              id="entrarEmail"
              name="email"
              placeholder="email"
              required
            />
            <label for="entrarNome"> Email: </label>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="form-floating col-lg-4">
            <input
              v-model="data.cpf"
              type="text"
              class="form-control"
              id="cpf"
              name="cpf"
              placeholder="cpf"
              required
            />
            <label for="cpf" class="form-label">CPF: </label>
          </div>
          <div class="form-floating col-lg-4">
            <input
              v-model="data.pis"
              type="text"
              class="form-control"
              id="pis"
              name="pis"
              placeholder="pis"
              required
            />
            <label for="pis" class="form-label">PIS: </label>
          </div>
          <div class="form-floating col-lg-4">
            <input
              v-model="data.password"
              type="password"
              class="form-control"
              id="entrarSenha"
              name="senha"
              placeholder="senha"
              required
            />
            <label for="entrarSenha" class="form-label">Senha: </label>
          </div>
        </div>
        <hr />
        <div class="row">
          <label class="form-label fw-bold fs-5">ENDEREÇO</label>
          <div class="form-floating col-lg-3">
            <input
              v-model="data.pais"
              type="text"
              class="form-control"
              id="pais"
              name="pais"
              placeholder="pais"
              required
            />
            <label for="pais" class="form-label">País: </label>
          </div>
          <div class="form-floating col-lg-3">
            <input
              v-model="data.cep"
              type="text"
              class="form-control"
              id="cep"
              name="cep"
              placeholder="cep"
              required
            />
            <label for="cep" class="form-label">CEP: </label>
          </div>
          <div class="form-floating col-lg-3">
            <input
              v-model="data.estado"
              type="text"
              class="form-control"
              id="estado"
              name="estado"
              placeholder="estado"
              required
            />
            <label for="estado" class="form-label">Estado: </label>
          </div>
          <div class="form-floating col-lg-3">
            <input
              v-model="data.cidade"
              type="text"
              class="form-control"
              id="cidade"
              name="cidade"
              placeholder="cidade"
              required
            />
            <label for="cidade" class="form-label">Cidade: </label>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="form-floating col-lg-5">
            <input
              v-model="data.rua"
              type="text"
              class="form-control"
              id="rua"
              name="rua"
              placeholder="rua"
              required
            />
            <label for="rua" class="form-label">Rua: </label>
          </div>
          <div class="form-floating col-lg-3">
            <input
              v-model="data.bairro"
              type="text"
              class="form-control"
              id="bairro"
              name="bairro"
              placeholder="bairro"
              required
            />
            <label for="bairro" class="form-label">Bairro: </label>
          </div>
          <div class="form-floating col-lg-2">
            <input
              v-model="data.numero"
              type="text"
              class="form-control"
              id="numero"
              name="numero"
              placeholder="numero"
              required
            />
            <label for="numero" class="form-label">Número: </label>
          </div>
          <div class="form-floating col-lg-2">
            <input
              v-model="data.complemento"
              type="text"
              class="form-control"
              id="complemento"
              placeholder="complemento"
              name="complemento"
            />
            <label for="complemento" class="form-label">Complemento: </label>
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="d-grid col-6 mx-auto">
            <button type="submit" class="btn btn-primary">CADASTRAR</button>
          </div>
        </div>
      </form>
    </main>
  </div>
</template>

<script>
import { reactive } from "@vue/reactivity";
import { useRouter } from "vue-router";

export default {
  name: "CadastroUsuario",

  setup() {
    const data = reactive({
      nome: "",
      email: "",
      password: "",
      cpf: "",
      pis: "",
      cep: "",
      pais: "",
      estado: "",
      cidade: "",
      bairro: "",
      rua: "",
      numero: "",
      complemento: "",
    });

    const router = useRouter();

    const submit = async () => {
      await fetch("http://127.0.0.1:8000/api/register", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify(data),
      })
        .then((response) => response.json())
        .then(async (res) => {
          if (!res.errors) {
            await router.push("/login");
          } else {
            alert("Verifique seus dados e tente novamente!");
          }
        });
    };

    return {
      data,
      submit,
    };
  },
};
</script>

<style scoped>
.container {
  display: flex;
  align-items: center;
  justify-content: center;
  align-content: center;
  padding-top: 3vh;
}

form {
  border: solid 1px #000;
  border-radius: 10px;
  padding: 3% 5% 1% 5%;
  /* background-color: #f2d7d9; */

  box-shadow: #000 0px 0px 5px;
}

#tituloCadastro {
  text-align: center;
  padding-top: 3vh;
}

.form-edit .form-floating:focus-within {
  z-index: 2;
}

.form-edit input {
  margin-bottom: -1px;
  margin-left: -5px;
}
</style>