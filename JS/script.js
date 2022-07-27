function verificaSelecao () {
    let escolhaApresentacao=document.getElementById('escolha').value;
    if (escolhaApresentacao == "comprimido"){
        let escolhaConcentracaoUm = document.getElementById('apresentacao');
        escolhaConcentracaoUm.disabled=true;
        let escolhaConcentracaoDois = document.getElementById('apresentacao2');
        escolhaConcentracaoDois.disabled=true;
        let escolhaConcentracaoTres = document.getElementById('apresentacao3');
        escolhaConcentracaoTres.disabled=true;
    } else {
        let escolhaConcentracaoUm = document.getElementById('apresentacao');
        escolhaConcentracaoUm.disabled=false;
        let escolhaConcentracaoDois = document.getElementById('apresentacao2');
        escolhaConcentracaoDois.disabled=false;
        let escolhaConcentracaoTres = document.getElementById('apresentacao3');
        escolhaConcentracaoTres.disabled=false;
    }
}