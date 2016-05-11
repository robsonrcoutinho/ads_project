/**
 * Created by Wilder on 11/05/2016.
 */
window.onload = function() {
    var pergunta_fechada = document.getElementById("pergunta_fechada");
    var escondida = document.getElementById('escondida');
    if (pergunta_fechada.checked) {
        escondida.style.display = 'block';
    } else {
        escondida.style.display = 'none';
    }
    pergunta_fechada.onclick = function () {
        if (pergunta_fechada.checked) {
            escondida.style.display = 'block';
        } else {
            escondida.style.display = 'none';
        }
    }
    var btn_adicionar = document.getElementById('btn-adicionar');
    btn_adicionar.onclick = function () {
        var texto = document.createElement("input");
        texto.setAttribute('class', 'form-control')
        var btn_excluir = document.createElement('button');
        btn_excluir.innerHTML = "Excluir";
        btn_excluir.setAttribute('class', 'btn')
        var div_opcao = document.createElement("div");

        div_opcao.appendChild(texto);
        div_opcao.appendChild(btn_excluir);
        btn_excluir.onclick = function () {
           escondida.removeChild(div_opcao);
        }
        escondida.appendChild(div_opcao);

    }
}

