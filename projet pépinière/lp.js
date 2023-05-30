let nb=document.getElementsByClassName("form-control")[1];
var str='';
var corps=document.getElementsByClassName("corps")[0];

nb.onkeydown=function(event){
    event.preventDefault();
    if(event.keyCode===13){
        for(let i=0;i<nb.value;i++){
            str+=`
        <div class="form-group">
            <input class="form-control" type="text" name="espece${i}" placeholder="espece">
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="var${i}" placeholder="variete">
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="p_g${i}" placeholder="porte_griffe">
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="nb_p${i}" placeholder="nombre de plantes">
        </div>`;

        }
        corps.innerHTML=str;
    }
    
}

