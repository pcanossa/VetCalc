<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css" >
    <title>VetCalc</title>
    <style>

        .medic {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: rgb(205, 199, 199);
            border-radius: 15px;
            margin-top: 15px;
            height:fit-content;
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .digita {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .digita input {
            border: none;
            border-radius: 5px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .botao p{
            margin-top: 5px;
        }

        .poso {
            background-color: rgba(245,245,245, 0.5)  ;
            border-radius: 15px;
            margin-top: 15px;
            margin-bottom: 5px;
            padding-top: 5px;
            padding-bottom: 5px;
            
        }

        .center {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-weight: bold;
        }

        .botaomed {
            border: 0px;
            width: fit-content;
            height: fit-content;
            border-radius: 5px;
            margin-top: 15px;
            margin-bottom: 10px;
            margin-left: 10px;
            background-color: rgb(12, 10, 114);
            color:aliceblue;
            font-weight: bold;
            padding-top: 5px;
            padding-bottom: 5px;
            text-align: center;
            color: aliceblue;
        }

        .botaomed:hover {
            background-color: aliceblue;
            transition: 0.5s;
            color: rgb(73, 72, 71) ;
        }

        .respesq {
            margin-top: 15px;
            margin-bottom: 0px;
        }
        
        .resultadopesquisa {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>

</head>
<body>
    <div class="container cabecalho">
    <div class="a"><i class="fa-solid fa-bone"> VetCalc</i></div>
    </div>
    <div class=" container corpo">
        <div class="cima-corpo">
            <p class="titulo">Informações do Animal/Medicação</p>
            <div class="peso">
                <p class="insert-peso">
                    Peso do Animal
                </p>
                <form action="" method="post">
                <input class="input-group input-group-sm mb-3" type="number" name="peso" id="peso" step="any" required>
            </div>
            <div class="dosagem">
                <p class="insert-peso">
                    Dosagem (mg/kg)
                </p>
                <input class="input-group input-group-sm mb-3" type='number' name="dosagem" id="dosagem" step="any" required>
                
            </div>
            <div class="concentracao">
                <p class="insert-peso">
                    Concentração (mg)
                </p>
                 <input class="input-group input-group-sm mb-3" type="number" name="concentracao" id="concentracao" step="any" required>
                
            </div>
        </div>
        <div class="baixo-corpo">
            <div class="escolha">
                <p>Forma de Apresentação</p>
                <select class="form-select" aria-label="Default select example" name="forma" id="escolha" onchange="javascript:verificaSelecao(this);" required>
                    <option disable selected value></option>
                    <option value="comprimido">Comprimido</option>
                    <option value="liquido" >líquido</option>
                    <option value="gotas" >gotas</option>
                    <option value="injetavel" >Injetável</option>
                </select>
                    <div class="form-check checkboxs">
                        <input class="form-check-input" type="radio" name="apresentacao" id="apresentacao" value="mgml" checked>
                        <label class="form-check-label" for="apresentacao1">
                        mg/ml
                        </label>
                    </div>
                    <div class="form-check checkboxs">
                        <input class="form-check-input" type="radio" name="apresentacao" id="apresentacao2" value="percentual">
                        <label class="form-check-label" for="apresentacao2">
                        concentração %
                        </label>
                    </div>
                    <div class="form-check checkboxs">
                        <input class="form-check-input" type="radio" name="apresentacao" id="apresentacao3" value="mgcemml">
                        <label class="form-check-label" for="apresentacao3">
                        mg/100ml
                        </label>
                    </div>
            </div>
               
            
            <div class="envia">
                <button type="submit" class="botao" value="Calcular" id="calcular" name="calcular">
                <i class="fa-solid fa-calculator"><p> Calcular</p></i>
                </button>
            </div>
            </form>
        </div>    
    </div>    
        

        
        
    
    <div class="container resultado">
        <?php
        
        if ((isset($_POST['calcular']))=='Calcular') {
            $peso=$_POST['peso'];
            $dosagem=$_POST['dosagem'];
            $concentracao=$_POST['concentracao'];
            $insuf=0;
            $apresentacao=$_POST['apresentacao'];
            $forma=$_POST['forma'];
            
            $dose=$peso*$dosagem;
            $cp=$dose/$concentracao;
            $and='';
            $inte=(int)$cp;
            $part=$cp-$inte;
            $pc=0;

            

            if ($forma=="comprimido") {
                if ($part> 0.01) { 
                    if (($part > 0.1) and ($part < 0.31)) {
                        $and='e 1/4';
                        $pc=0.25;
                        }
                    if (($part > 0.3) and ($part< 0.61)) {
                        $and='e 1/2';
                        $pc=0.50;
                        }
                    if (($part > 0.6) and ($part< 0.81)) {
                        $and='e 3/4';
                        $pc=0.75;
                        }
                    if ($part > 0.76) {
                        $pc=0;
                        if ($inte>=1) {
                            $and='0';
                            $inte=$inte+1;
                            }
                        else {
                            $and = '0';
                            $inte = 1;
                        }
                        }
                }
                else  {
                        $pc=0;
                
                }
                
                $dcc=$pc*$concentracao;
                $dc=$inte*$concentracao;
                $dosecp=$dcc+$dc;
                
                
                if ($part < 0.1 ){
                    if ($cp < 1) {
                        $insuf=1;
                    }
                        
                }
                if (($insuf==1)&&($inte==0)){
                    echo "<p>Dosagem mínima de partição muito alta para a dose individual. Apresentação incompatível</p>";
                } else {   
                    echo "<p>A dose em miligramas que o animal deve tomar é de $dose mg. </p><br>";       
                    echo "<p>dosagem é de $inte comprimido(s) inteiro(s) $and. </p><br>";
                    echo "<p>Essa dose correponde à $dosecp mg. </p><br>";
                }    
                
            }  
            
            if ($forma=="liquido" || $forma=="injetavel" || $forma=="gotas"){                
                if ($apresentacao=="percentual"){
                    $concentracao=$concentracao*10;
                }

                if ($apresentacao=="mgcemml"){
                    $concentracao=$concentracao*0.01;
                }    
                
                $mg=$dosagem*$peso;
                $dose=$dosagem/$concentracao;
                $qntliquido=$dose*$peso;
                $dosetotal=$qntliquido*$concentracao;
                $gotas=$qntliquido/0.05;
                echo "<p>A dose em miligramas que o animal deve tomar é de $mg mg. </p><br>";                       
                echo "<p>O volume de medicação a ser administrada é de $qntliquido ml. </p><br>";
                if ($forma=="gotas"){
                    echo "<p>Correspondente à $gotas gotas. </p><br>";
                }
                echo "<p>Essa dose correponde à $dosetotal mg. </p><br>";        
                
            }
            clearstatcache();    
        }
        ?>
    </div>

    <div class="container medic">
        <h5>CONSULTA DE DOSES E APRESENTAÇÕES COMERCIAIS</h5>
        <form action="" method="post" class="entra">
        <div class="digita">
            <label >Nome da medicação</label>
            <input type="text" class="digitaentra" id="digitaentra" name="medicacaop" value="" required>
        </div> 
        <div class="botaomedic">
            <button type="submit" class="botao" value="Pesquisar" id="pesquisar" name="pesquisar">
            <i class="fa-solid fa-magnifying-glass"><p> PESQUISAR</p></i>
            </button>
        </div>
        </form>   
    

        <div class="resultadopesquisa">
        <?php
            $continua='nao';
            if ((isset($_POST['pesquisar']))=="Pesquisar") {
                $host="212.1.208.201";
                $user="u995612138_admin";
                $password='Pcg458778';
                $dbname="u995612138_vetcalc";
                $nome=$_POST['medicacaop'];
                

                $con = new mysqli($host, $user, $password, $dbname)
                    or die ('Could not connect to the database server' . mysqli_connect_error());
                    
            
                $pesquisa="SELECT * FROM medicacoes WHERE nome LIKE '%$nome%'";
                $resultado=mysqli_query($con, $pesquisa) or die ('Nenhuma medicação encontrada.');
                $retorno=mysqli_fetch_assoc($resultado);
                if ($retorno) {
                    $continua='sim';

                } else if ($continua=='nao'){
                    echo ('Nenhuma medicação encontrada');
                }
            }    

            if ($continua=='sim'){
                echo ("<p class='respesq'>Resultado da Pesquisa: </p>");
                $nome=$retorno['nome'];
                $id=$retorno['id'];
                echo ("<form action='' method='post' class='centro'>");
                echo ("<input type='submit' class='botaomed' value='$nome' id='ir' name='ir'></input>");
                
    


                while ($linha=mysqli_fetch_assoc($resultado)) {
                    $nome=$linha['nome'];
                    $id=$linha['id'];
                    echo ("<input type='submit' class='botaomed' value='$nome' id='ir' name='ir'></input>");

                    

                   

                }
                echo ("</form>"); 
            }    
                $retorno2='';
                if (isset($_POST['ir'])) {

                    $host="212.1.208.201";
                    $user="u995612138_admin";
                    $password='Pcg458778';
                    $dbname="u995612138_vetcalc";
                    
                    

                    $con = new mysqli($host, $user, $password, $dbname)
                        or die ('Could not connect to the database server' . mysqli_connect_error());

                    $nom=$_POST['ir'];
                    $pesquisa="SELECT * FROM medicacoes WHERE nome ='$nom'";
                    $resultado=mysqli_query($con, $pesquisa) or die ('Nenhuma medicação encontrada.');
                    $retorno2=mysqli_fetch_assoc($resultado);
                           
                        if ($retorno2) {
                            echo ("<div class='container poso'>");
                            echo "<div class='center' >DOSES <br></div>";
                            echo "<br>";
                        
                            $dosecanmin=$retorno2['canminimo'];
                            $dosecanmax=$retorno2['canmaximo'];
                            $dosefelmin=$retorno2['felminimo'];
                            $dosefelmax=$retorno2['felmaximo'];
                            $dosecanmin=number_format($dosecanmin, 1 , ",", ".");
                            $dosecanmax=number_format($dosecanmax, 1 , ",", ".");
                            $dosefelmin=number_format($dosefelmin, 1 , ",", ".");
                            $dosefelmax=number_format($dosefelmax, 1 , ",", ".");
                            echo "<i class='fa-solid fa-dog'>: <br></i>";
                            echo " $dosecanmin mg/kg - $dosecanmax mg/kg<br>";
                            echo "<i class='fa-solid fa-cat'>: <br></i>";
                            echo " $dosefelmin mg/kg - $dosefelmax mg/kg<br><br>";
                            $id=$retorno2['id'];
                            echo ("</div>");

                            echo ("<div class='container poso'>");
                            $identv="SELECT * FROM apresentacoes WHERE med=$id and tipo='v'";
                            $pesqidv=mysqli_query($con, $identv);
                            $resultidv=mysqli_fetch_assoc($pesqidv);
                            $identh="SELECT * FROM apresentacoes WHERE med=$id and tipo='h'";
                            $pesqidh=mysqli_query($con, $identh);
                            $resultidh=mysqli_fetch_assoc($pesqidh);
                            if ($resultidv) {
                                echo ("<div class='center'>APRESENTAÇÕES VETERINÁRIAS</div><br>"); 

                                $cp="SELECT * FROM apresentacoes WHERE med=$id and tipo='v' and apresentacao='c'";
                                $pesqcp=mysqli_query($con, $cp);
                                $resultidcp=mysqli_fetch_assoc($pesqcp);
                                if ($resultidcp){
                                    echo ('<i class="fa-solid fa-tablets"> Comprimidos</i><br>');
                                    $nome=$resultidcp['nome'];
                                    $marca=$resultidcp['marca'];
                                    $concentracao=$resultidcp['concentracao'];
                                    $concentracao=number_format($concentracao, 1 , ",", ".");
                                    echo ("$nome ($marca) - $concentracao mg<br>");
                                while ($resultcp=mysqli_fetch_assoc($pesqcp)) {
                                    $nome=$resultcp['nome'];
                                    $marca=$resultcp['marca'];
                                    $concentracao=$resultcp['concentracao'];
                                    $concentracao=number_format($concentracao, 1 , ",", ".");
                                    echo ("$nome ($marca) - $concentracao mg<br>");
                                }  
                                }
                                
                                $lq="SELECT * FROM apresentacoes WHERE med=$id and tipo='v' and apresentacao='l'";
                                $pesqlq=mysqli_query($con, $lq);
                                $resultidlq=mysqli_fetch_assoc($pesqlq);
                                if ($resultidlq){
                                    echo ('<i class="fa-solid fa-vial">Liquido</i><br>');
                                    $nome=$resultidlq['nome'];
                                    $marca=$resultidlq['marca'];
                                    $concentracao=$resultidlq['concentracao'];
                                    $concentracao=number_format($concentracao, 1 , ",", ".");
                                    echo ("$nome ($marca) - $concentracao mg/ml<br>");
                                while ($resultlq=mysqli_fetch_assoc($pesqlq)) {
                                    $nome=$resultlq['nome'];
                                    $marca=$resultlq['marca'];
                                    $concentracao=$resultlq['concentracao'];
                                    $concentracao=number_format($concentracao, 1 , ",", ".");
                                    echo ("$nome ($marca) - $concentracao mg/ml<br>");
                                } 
                                }
                                
                                $gt="SELECT * FROM apresentacoes WHERE med=$id and tipo='v' and apresentacao='g'";
                                $pesqgt=mysqli_query($con, $gt);
                                $resultidgt=mysqli_fetch_assoc($pesqgt);
                                if ($resultidgt){
                                    $nome=$resultidgt['nome'];
                                    $marca=$resultidgt['marca'];
                                    $concentracao=$resultidgt['concentracao'];
                                    $concentracao=number_format($concentracao, 1 , ",", ".");
                                    echo ('<i class="fa-solid fa-droplet">Gotas</i><br>');
                                    echo ("$nome ($marca) - $concentracao mg/ml<br>");
                                while ($resultgt=mysqli_fetch_assoc($pesqgt)) {
                                    $nome=$resultgt['nome'];
                                    $marca=$resultgt['marca'];
                                    $concentracao=$resultgt['concentracao'];
                                    $concentracao=number_format($concentracao, 1 , ",", ".");
                                    echo ("$nome ($marca) - $concentracao mg/ml<br>");
                                }
                                }    

                                $ij="SELECT * FROM apresentacoes WHERE med=$id and tipo='v' and apresentacao='i'";
                                $pesqij=mysqli_query($con, $ij);
                                $resultij=mysqli_fetch_assoc($pesqij);
                                if ($resultij){
                                    echo ('<i class="fa-solid fa-syringe">Injetavel</i><br>');
                                    $nome=$resultij['nome'];
                                    $marca=$resultij['marca'];
                                    $concentracao=$resultij['concentracao'];
                                    $concentracao=number_format($concentracao, 1 , ",", ".");
                                    echo ("$nome ($marca) - $concentracao mg/ml<br>");
                                while ($resultiij=mysqli_fetch_assoc($pesqij)) {
                                    $nome=$resultiij['nome'];
                                    $marca=$resultiij['marca'];
                                    $concentracao=$resultiij['concentracao'];
                                    $concentracao=number_format($concentracao, 1 , ",", ".");
                                    echo ("$nome ($marca) - $concentracao mg/ml<br>");
                                }  
                                } 
                            }    
                            if ($resultidh) {
                                    echo ("<br><div class='center'>APRESENTAÇÕES HUMANAS</div><br>"); 
            
                                    $cp="SELECT * FROM apresentacoes WHERE med=$id and tipo='h' and apresentacao='c'";
                                    $pesqcp=mysqli_query($con, $cp);
                                    $resultdcph=mysqli_fetch_assoc($pesqcp);
                                    if ($resultdcph){
                                        echo ('<i class="fa-solid fa-tablets"> Comprimidos</i><br>');
                                        $nome=$resultdcph['nome'];
                                        $marca=$resultdcph['marca'];
                                        $concentracao=$resultdcph['concentracao'];
                                        $concentracao=number_format($concentracao, 1 , ",", ".");
                                        echo ("$nome ($marca) - $concentracao mg<br>");
                                    while ($resultcp=mysqli_fetch_assoc($pesqcp)) {
                                        $nome=$resultcp['nome'];
                                        $marca=$resultcp['marca'];
                                        $concentracao=$resultcp['concentracao'];
                                        $concentracao=number_format($concentracao, 1 , ",", ".");
                                        echo ("$nome ($marca) - $concentracao mg<br>");
                                    }
                                    }  
                                    
                                    $lq="SELECT * FROM apresentacoes WHERE med=$id and tipo='h' and apresentacao='l'";
                                    $pesqlq=mysqli_query($con, $lq);
                                    $resultidlqh=mysqli_fetch_assoc($pesqlq);
                                    if ($resultidlqh){
                                        echo ('<i class="fa-solid fa-vial">Liquido</i><br>');
                                        $nome=$resultidlqh['nome'];
                                        $marca=$resultidlqh['marca'];
                                        $concentracao=$resultidlqh['concentracao'];
                                        $concentracao=number_format($concentracao, 1 , ",", ".");
                                        echo ("$nome ($marca) - $concentracao mg/ml<br>"); 
                                    while ($resultlq=mysqli_fetch_assoc($pesqlq)) {
                                        $nome=$resultlq['nome'];
                                        $marca=$resultlq['marca'];
                                        $concentracao=$resultlq['concentracao'];
                                        $concentracao=number_format($concentracao, 1 , ",", ".");
                                        echo ("$nome ($marca) - $concentracao mg/ml<br>");
                                    } 
                                    }
                                    
                                    $gt="SELECT * FROM apresentacoes WHERE med=$id and tipo='h' and apresentacao='g'";
                                    $pesqgt=mysqli_query($con, $gt);
                                    $resultgth=mysqli_fetch_assoc($pesqgt);
                                    if ($resultgth){
                                        echo ('<i class="fa-solid fa-droplet">Gotas</i><br>');
                                        $nome=$resultgth['nome'];
                                        $marca=$resultgth['marca'];
                                        $concentracao=$resultgth['concentracao'];
                                        $concentracao=number_format($concentracao, 1 , ",", ".");
                                        echo ("$nome ($marca) - $concentracao mg/ml<br>");
                                    while ($resultgt=mysqli_fetch_assoc($pesqgt)) {
                                        $nome=$resultgt['nome'];
                                        $marca=$resultgt['marca'];
                                        $concentracao=$resultgt['concentracao'];
                                        $concentracao=number_format($concentracao, 1 , ",", ".");
                                        echo ("$nome ($marca) - $concentracao mg/ml<br>");
                                    }
                                    }    
            
                                    $ij="SELECT * FROM apresentacoes WHERE med=$id and tipo='h' and apresentacao='i'";
                                    $pesqij=mysqli_query($con, $ij);
                                    $resultidijh=mysqli_fetch_assoc($pesqij);
                                    if ($resultidijh){
                                        echo ('<i class="fa-solid fa-syringe">Injetavel</i><br>');
                                        $nome=$resultidijh['nome'];
                                        $marca=$resultidijh['marca'];
                                        $concentracao=$resultidijh['concentracao'];
                                        $concentracao=number_format($concentracao, 1 , ",", ".");
                                        echo ("$nome ($marca) - $concentracao mg/ml<br>");
                                    while ($resultij=mysqli_fetch_assoc($pesqij)) {
                                        $nome=$resultij['nome'];
                                        $marca=$resultij['marca'];
                                        $concentracao=$resultij['concentracao'];
                                        $concentracao=number_format($concentracao, 1 , ",", ".");
                                        echo ("$nome ($marca) - $concentracao mg/ml<br>");
                                    } 
                                    }   
                            
                                }  
                                echo ("</div>");         

                }
                                    

                                        


                                

                                
                                    
                            
                            
                            
                        }
                        
                    
                            
                
                
            
                       
        ?>
        </div>
    </div>
    <script type="text/javascript" src="JS/script.js"> </script>
</body>
<div class="container creditos">
    <footer>Criada por Patrícia Canossa Gagliardi, para sugestões clique <a href="mailto:p.canossa@hotmail.com">aqui</a></footer>
</div>  
<script src="https://kit.fontawesome.com/707f1f01cc.js" crossorigin="anonymous"></script>  
</html>