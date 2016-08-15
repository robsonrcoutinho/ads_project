/**
 * Created by Wilder on 11/05/2016.
 */
window.onload = function () {
    var excluir = document.getElementsByClassName('btn-danger');
    for (var i = 0; i < excluir.length; i++) {
        excluir[i].onclick = function () {
            return confirm("Tem certeza que deseja excluir?");
        }
    }
    var pergunta_fechada = document.getElementById("pergunta_fechada");
    var escondida = document.getElementById('escondida');
    if (!pergunta_fechada.checked) {
        escondida.style.display = 'none';
    } else {
        escondida.style.display = 'block';
    }
    pergunta_fechada.addEventListener("click", function () {
        if (pergunta_fechada.checked) {
            escondida.style.display = 'block';
        } else {
            escondida.style.display = 'none';
        }
    });
    var btn_adicionar = document.getElementById('btn-adicionar');
    btn_adicionar.addEventListener("click",function () {
        var texto = document.createElement("input");
        texto.setAttribute('class', 'form-control');
        texto.setAttribute('name', 'opcoes_resposta[]');
        var btn_excluir = document.createElement('button');
        btn_excluir.innerHTML = "Excluir";
        btn_excluir.setAttribute('class', 'btn');
        var div_opcao = document.createElement("div");
        div_opcao.appendChild(texto);
        div_opcao.appendChild(btn_excluir);
        btn_excluir.addEventListener("click",function () {
            escondida.removeChild(div_opcao);
        });
        escondida.appendChild(div_opcao);
    });
};
function excluir_div(id) {
    if (confirm("Tem certeza que deseja remover?")) {
        var div = document.getElementById(id);
        div.parentNode.removeChild(div);
    }
}
