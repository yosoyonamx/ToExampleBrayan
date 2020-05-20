const app = new Vue({
  el: "#appCategoria",
  data: {
    id: 0,
    tituloE: "",
    urlE: "",
    imgE: null,
    titulo: "",
    url: "",
    img: null,
    mensaje: "",
    mensaje_titulo: "",
    boton_status: "",
    categorias: [],
  },
  methods: {
    getImage(event) {
      //Asignamos la imagen a  nuestra data
      this.imgE = event.target.files[2];
      alert(this.imgE.target);
    },
    listarCategoria: function () {
      var url = "controller/categoriaController.php?op=1";
      axios.get(url).then((res) => {
        this.categorias = res.data;
      });
    },
    verificarCategoria: function (titulo) {
      var url = "controller/categoriaController.php?op=2";
      axios.post(url, { titulo: titulo }).then((res) => {
        switch (res.data) {
          case 0:
            this.mensaje_titulo = "badge badge-danger";
            this.mensaje = "Este titulo ya existe";
            this.boton_status = "disabled";
            break;
          case 1:
            this.mensaje_titulo = "badge badge-success";
            this.mensaje = "Titulo disponible";
            this.boton_status = "";
            break;
          case 2:
            this.mensaje_titulo = "badge badge-warning";
            this.mensaje = "Por favor llene el campo";
            this.boton_status = "disabled";
            break;
        }
      });
    },
    verificaAgregar: function () {
      this.verificarCategoria(this.titulo);
    },
    verificaEdita: function () {
      this.verificarCategoria(this.tituloE);
    },
    agregarCategoria: function () {
      var url = "controller/categoriaController.php?op=3";
      axios
        .post(url, {
          titulo: this.titulo,
          url: this.url,
        })
        .then((res) => {
          this.mensaje = "";
          this.titulo = "";
          this.url = "";
          $("#modalCategoria").modal("hide");
          this.listarCategoria();
        });
    },
    llenarModal: function (item) {
      this.id = item.id;
      this.tituloE = item.titulo;
      this.urlE = item.url;
    },
    editarCategoria: function () {
      var url = "controller/categoriaController.php?op=4";
      axios
        .post(url, {
          titulo: this.tituloE,
          url: this.urlE,
          id: this.id,
        })
        .then((res) => {
          this.tituloE = "";
          this.urlE = "";
          $("#editarCategoria").modal("hide");
          this.listarCategoria();
        });
    },
    eliminarCategoria: function (id) {
      Swal.fire({
        title: "Seguro?",
        text: "Esta accion es irremediable!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Matalo!",
      }).then((result) => {
        if (result.value) {
          var url = "controller/categoriaController.php?op=5";
          axios
            .post(url, {
              id: id,
            })
            .then((res) => {
              this.listarCategoria();
            });
          Swal.fire("Borrado!", "Tu archivo ha sido eliminado.", "success");
        } else {
          Swal.fire("Cancelaste!", "F.", "error");
        }
      });
    },
  },
  created: function () {
    this.listarCategoria();
  },
  computed: {
    generarURL: function () {
      var char = {
        á: "a",
        é: "e",
        í: "i",
        ó: "o",
        ú: "u",
        Á: "A",
        É: "E",
        Í: "I",
        Ó: "O",
        Ú: "U",
        ñ: "n",
        Ñ: "N",
        " ": "-",
        _: "-",
        "'": "-",
        ".": "-",
        ":": "-",
      };
      var expr = /[áéíóúÁÉÍÓÚÑñ_.:' ]/g;
      this.url = this.titulo
        .trim()
        .replace(expr, (e) => {
          return char[e];
        })
        .toLowerCase();
      return this.url;
    },
    generarURLE: function () {
      var char = {
        á: "a",
        é: "e",
        í: "i",
        ó: "o",
        ú: "u",
        Á: "A",
        É: "E",
        Í: "I",
        Ó: "O",
        Ú: "U",
        ñ: "n",
        Ñ: "N",
        " ": "-",
        _: "-",
        "'": "-",
        ".": "-",
        ":": "-",
      };
      var expr = /[áéíóúÁÉÍÓÚÑñ_.:' ]/g;
      this.urlE = this.tituloE
        .trim()
        .replace(expr, (e) => {
          return char[e];
        })
        .toLowerCase();
      return this.urlE;
    },
  },
});
