<template>
  <h1 id="tituloEditar">EDITAR USUÁRIO</h1>
  <div class="container">
    <main class="form-edit w-100 m-auto">
      <form @submit.stop.prevent="submit">
        <div class="row">
          <label class="form-label fw-bold fs-5">INFORMAÇÕES PESSOAIS</label>
            <input type="hidden" v-model="user.id" />
          <div class="form-floating col-lg-6">
            <input
              v-model="user.nome"
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
              v-model="user.email"
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
              v-model="user.cpf"
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
              v-model="user.pis"
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
              v-model="user.password"
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
              v-model="user.pais"
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
              v-model="user.cep"
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
              v-model="user.estado"
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
              v-model="user.cidade"
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
              v-model="user.rua"
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
              v-model="user.bairro"
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
              v-model="user.numero"
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
              v-model="user.complemento"
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
            <button type="submit" class="btn btn-primary">EDITAR</button>
          </div>
           <div class="d-grid col-6 mx-auto">
            <button @click="$router.push('/logout')" v-on:click="deletar_usuario(user.id)" class="btn btn-danger">DELETAR USUÁRIO</button>
          </div>
        </div>
      </form>
    </main>
  </div>
</template>

<script>
import Cookie from "js-cookie";
import { useRouter } from "vue-router";

export default {
  name: "EditCadastro",
  data() {
    return {
      user: "",
      id: "",
      nome: "",
      email: "",
      cpf: "",
      pis: "",
      password: "",
      pais: "",
      cep: "",
      estado: "",
      cidade: "",
      rua: "",
      bairro: "",
      numero: "",
      complemento: "",
    };
  },
  methods: {
    deletar_usuario(id){
        const router = useRouter();
        fetch("http://127.0.0.1:8000/api/delete/"+id, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${Cookie.get("_pontotel_token")}`
            }
        })
          router.push("/logout");

    },
    pegar_dados() {
      fetch("http://127.0.0.1:8000/api/user", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          Authorization: `Bearer ${Cookie.get("_pontotel_token")}`,
        },
      })
        .then((response) => response.json())
        .then((res) => {
          this.user = res;
        });
    },
    submit() {
      const payload = {
        id: this.id,
        nome: this.nome,
        email: this.email,
        cpf: this.cpf,
        pis: this.pis,
        password: this.password,
        pais: this.pais,
        cep: this.cep,
        estado: this.estado,
        cidade: this.cidade,
        rua: this.rua,
        bairro: this.bairro,
        numero: this.numero,
        complemento: this.complemento,
      };

      fetch("http://127.0.0.1:8000/api/update", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
        },
        body: JSON.stringify(payload),
      }).then((response) => response.json());
    },
  },
  mounted() {
    this.pegar_dados();
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

#tituloEditar {
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