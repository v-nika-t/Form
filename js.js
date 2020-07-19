function login() {

    let login = document.getElementsByName("login")[0].value;
    let password = document.getElementsByName("password")[0].value;
    let str = "login=" + login + "&password=" + password + "&c=Base&act=Form";

    $.ajax({
        type: 'GET',
        url: 'index.php?&c=Base&act=Form',
        data: str,
        success: function (answer) {

            let result = JSON.parse(answer);

            if (!(result.result)) {


                document.getElementById('login').remove();
                let div = document.createElement('div');


                div.className = "hello";
                div.innerHTML = "Приветствую тебя: <strong>" + result.name + "</strong><br><br><a href=\"index.php?c=Main&act=Logout\"><button>Выйти</button></a><br><br>";
                document.body.append(div);

            } else {

                alert(result.result);

            }

        }


    });


}

function registration() {


    let login = document.getElementsByName("login")[0].value;
    let password = document.getElementsByName("password")[0].value;
    let confirmPassword = document.getElementsByName("confirmPassword")[0].value;
    let email = document.getElementsByName("email")[0].value;
    let name = document.getElementsByName("name")[0].value;

    if (password == confirmPassword) {

        $.ajax({
            type: 'POST',
            url: 'index.php?&c=Base&act=Registration',
            data: {
                login: login,
                password: password,
                email: email,
                name: name,
            },

            success: function (answer) {

                let result = JSON.parse(answer);

                if (result.name) {

                    document.getElementById('registration').remove();
                    let div = document.createElement('div');


                    div.className = "hello";
                    div.innerHTML = "Личный кабинет зарегистрирован.<br><br> Приветствую тебя: <strong>" + result.name + "</strong><br><br><a href=\"index.php?c=Main&act=Logout\"><button>Выйти</button></a><br><br>";
                    document.body.append(div);

                } else {

                    alert(result.result);

                }

            }


        });

    } else {

        alert('Подтверждение пароля не совпадает');

    }

}
