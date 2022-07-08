<template>
  <div class="homepage">
    <h1>Olá, {{ user.nome }}</h1>
    <div class="container">
      <div class="row">
        <div class="d-grid gap-2 col-6 mx-auto">
          <button @click="$router.push('/logout')" class="btn btn-danger">
            Logout
          </button>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
          <button @click="$router.push('/editar_usuario')" class="btn btn-secondary">
            Editar Usuário
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Cookie from "js-cookie";

export default {
  name: "HomePage",
  data() {
    return {
      user: "",
    };
  },
  mounted() {
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
};
</script>
<style>
.homepage {
  padding: 20%;
  text-align: center;
}
</style>