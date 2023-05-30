let corps=document.getElementsByClassName("corps")[0];
let rad_p=document.getElementsByClassName("radioLabel")[0];
let rad_m=document.getElementsByClassName("radioLabel")[1];
let but_p=document.getElementsByClassName("p")[0];
let but_m=document.getElementsByClassName("m")[0];




function click_p(){
    corps.innerHTML=`
    <div class="form-group">
        <input class="form-control" type="text" name="n_pepinierist" placeholder="Nom du pépinièriste">
    </div>
    <div class="form-group">
        <input class="form-control" type="text" name="cin" placeholder="CIN">
    </div>
    <div class="form-group">
        <input class="form-control" type="text" name="tel" placeholder="Tel">
    </div>
    <div class="form-group">
        <input class="form-control" type="text" name="adress" placeholder="Adresse du pépinièriste">
    </div>
    <div class="form-group">
        <input class="form-control" type="text" name="n_pep" placeholder="Nom de la pépinière">
    </div>
    <div class="form-group">
        <input class="form-control" type="text" name="adress_pep" placeholder="Adresse de la pépinière">
    </div>
    <div class="form-group">
        <input class="form-control" type="text" name="user" placeholder="Username">
    </div>
    <div class="form-group">
        <input id="pass" class="form-control" type="text" name="pass" placeholder="Password">
    </div>
    <div class="form-group">
        <input id="c_pass" class="form-control" type="text" name="c_pass" placeholder="Confirmer le password">
    </div>
    <button class="btn btn-success" type="submit" name="submit">S'inscrire</button>
    `;

    but_p.style.cssText=`
    background:linear-gradient(#288347,#07a82a);
    box-shadow: 0 0 5px #050515;
    `;
    but_m.style.removeProperty("background");
}

function click_m(){
    corps.innerHTML=`
    <div class="form-group">
                <input class="form-control" type="text" name="n_pep" placeholder="Nom de la pépinière">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="adress_pep" placeholder="Adresse de la pépinière">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="tel" placeholder="Tel">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="ice" placeholder="ICE">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="rc" placeholder="RC">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="user" placeholder="Username">
            </div>
            <div class="form-group">
                <input id="pass" class="form-control" type="text" name="pass" placeholder="Password">
            </div>
            <div class="form-group" id="div_c_pass">
                <input id="c_pass" class="form-control" type="text" name="c_pass" placeholder="Confirmer le password">
            </div>
            <button class="btn btn-success" type="submit" name="submit">S'inscrire</button>
    `;
    but_m.style.cssText=`
    background:linear-gradient(#288347,#07a82a);
    box-shadow: 0 0 5px #050515;
    `;

    but_p.style.removeProperty("background");
}



