function MostrarErro()
{
    swal({
        title: "Falha no Login",
        text: "Usuário ou senha incorretos.",
        icon: "error",
        button: "Ok",
      })
      .then(value =>
      {
        if(value)
        {
            window.location.href = "javascript: history.go(-1)";        
        }

      });
}