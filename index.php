<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css" >
    <title>VetCalc</title>
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
                <select class="form-select" aria-label="Default select example" name="forma">
                    <option value="comprimido" selected >Comprimido</option>
                    <option value="liquido" >líquido</option>
                    <option value="gotas" >gotas</option>
                    <option value="injetavel" >Injetável</option>
                </select>
                    <div class="form-check checkboxs">
                        <input class="form-check-input" type="radio" name="apresentacao" id="mgml" value="mgml" checked>
                        <label class="form-check-label" for="apresentacao1">
                        mg/ml
                        </label>
                    </div>
                    <div class="form-check checkboxs">
                        <input class="form-check-input" type="radio" name="apresentacao" id="percentual" value="percentual">
                        <label class="form-check-label" for="apresentacao2">
                        concentração %
                        </label>
                    </div>
                    <div class="form-check checkboxs">
                        <input class="form-check-input" type="radio" name="apresentacao" id="mgcemml" value="mgcemml">
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
        </div>    
    </div>    
        </form>

        
        
    
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
            $pc=1;
            

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
                echo $dosagem, $concentracao;
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
    
</body>
<div class="container creditos">
    <footer>Criada por Patrícia Canossa Gagliardi, para sugestões clique <a href="mailto:p.canossa@hotmail.com">aqui</a></footer>
</div>  
<script src="https://kit.fontawesome.com/707f1f01cc.js" crossorigin="anonymous"></script>  
</html>