$('#save').click(function () {//сохраняем клиента
    if (fieldsAreFilled() && checkNumber() && checkPasport() &&
    (checkMail() || confirm('такой Email не может быть записан, продолжить?'))) {
        let n = document.getElementById("select-client").options.selectedIndex;
        let pasportId = document.getElementById("pasportId").value;
        let pasportSeries = document.getElementById("pasportSeries").value;
        $.ajax({//проверка зарегистрирован ли паспорт если вводим нового пользователя
            type: "POST",
            url: "php/checkPasport.php",
            port: '60',
            dataType: 'html',
            data: ({id:n,
                    pasportId:pasportId, 
                    pasportSeries:pasportSeries}),
            success: function (isNot) {//сохранить 
                if (isNot) {
                    data = createSave();
                    $.ajax({
                        type: "POST",
                        url: "php/save.php",
                        port: '60',
                        dataType: 'html',
                        data: data,
                        success: printResult
                    });
                }else{
                    alert('Клиент с такими паспортными данными уже существует');
                }
            }
        });
    }
});
$('#delete').click(function(){//помечаем пользователя как удаленного
    let n = document.getElementById("select-client").options.selectedIndex;
    if(n>0){
        $.ajax({
            type:"POST",
            url: "php/delete.php",
            port: '60',
            dataType: 'html',
            data: ({id:n}),
            success: printResult
        });
    }
});
$('#print').click(function(){//выводим шаблон документа
    if(fieldsAreFilled()&&checkNumber()&&checkPasport()&&
    (checkMail()||confirm('такой Email не может быть записан, продолжить?'))){
        window.open('primer_dogovora.html');
    }
});
$('#select-client').bind("change", function(){//выводим информацию о клиенте в поля 
    let n = document.getElementById("select-client").options.selectedIndex;
    if(n>0){
        $.ajax({
            type:"POST",
            url: "php/selectClient.php",
            port: '60',
            dataType: 'html',
            data: ({id:n}),
            success: displayPerson
        });
        document.getElementById('delete').removeAttribute('disabled');
        blockPersonInformation(['name','surname','patronymic',"pasportSeries","pasportId","whereIssued","whenIssued"]);
    }else{
        clearFields();
        document.getElementById('delete').setAttribute('disabled',true);
        unlockPersonInformation(['name','surname','patronymic',"pasportSeries","pasportId","whereIssued","whenIssued"]);
    }
});

function displayPerson(result){//вывод информации о клиенте в инпуты
    let data = JSON.parse(result);
    for(let item in data){
        $(`#${item}`).val(data[item]);
    }
};

function clearFields(){//очистка инпутов
    let fields = document.getElementsByTagName('input');
    for(let i=0;i<fields.length;i++){
        fields[i].value = '';
    }
}

function printResult(result){//вывод сообщения от свервера
    alert(result);
    location.reload();
};

function createSave(){//создание объекта для отправки в POST
    let save = {};
    save['id'] = document.getElementById("select-client").options.selectedIndex;
    let properties = document.getElementsByTagName('input');
    for(let i=0;i<properties.length;i++){
        if(properties[i].id=='mail'){
            save[properties[i].id]=getMail();
        }
        save[properties[i].id]=properties[i].value;
    }
    return save;
};

function blockPersonInformation(ids){
    ids.forEach(element => {
        document.getElementById(element).setAttribute('readonly','readonly');
    });
};

function unlockPersonInformation(ids){
    ids.forEach(element => {
        document.getElementById(element).removeAttribute('readonly');
    });
};

function fieldsAreFilled(){//проверка обязательных для заполнения инпутов
    let fieldsAreFilled = true;
    let properties = document.getElementsByTagName('input');
    for(let i=0;i<properties.length;i++){
        if(properties[i].id!='mail'&&properties[i].value==''){
            fieldsAreFilled = false;
        }
    }
    if(!fieldsAreFilled) alert('Не заполнены все обязательные поля!');
    return fieldsAreFilled;
}

function checkNumber(){
    let number = document.getElementById('telephoneNumber').value;
    let result = number.length==10;
    if(!result) alert('Телефон должен иметь формат 10 символов: XXXXXXXXXX');
    return (result);
}

function checkMail(){
    //var r = /^[\w\.\d-_]+@[\w\.\d-_]+\.\w{2,4}$/i;
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    adress = document.getElementById('mail').value;
    return reg.test(adress);
}

function getMail(){
    let result='';
    if(checkMail()){
        result=document.getElementById('mail').value;
    }
    return result;
}

function checkPasport(){
    let result = false;

    let series = document.getElementById('pasportSeries').value;
    let ID = document.getElementById('pasportId').value;
    if(!(/\D/.test(series))&&!(/\D/.test(ID))){
        series = parseInt(series,10);
        ID = parseInt(ID,10);
        if((series>999&&series<10000)&&(ID>99999&&ID<1000000)){
            result=true;
        }
    }
    if(!result) alert('Неправильная запись паспортных данных!');
    return result;
}