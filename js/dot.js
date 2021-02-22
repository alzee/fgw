// addEventListener to proxy_status textarea
let table_select = document.getElementById('select_table_name');
if(table_select){
	table_select.addEventListener('change', getFields);
	getFields();
}

function getFields() {
	let table = table_select.value;
	let xhr = new XMLHttpRequest();
	let url = '/fgw/fields?table=' + table;
	xhr.onreadystatechange = function () {
		if(xhr.readyState === XMLHttpRequest.DONE){
			if(xhr.status === 200){
				//console.log(xhr.response);
				listFields(xhr.response);
			}
		}
	};
	xhr.open('GET', url);
	xhr.responseType='json';
	//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send();
}

function listFields(fields) {
	let feild_list = document.getElementById('fields_list');
	let feild_input = document.importNode(feild_list.firstElementChild, true);
	feild_list.innerHTML='';
	for (let i = 0; i < fields.length; i++) {
		let input = document.importNode(feild_input, true);
		input.firstElementChild.setAttribute('for', fields[i]);
		input.firstElementChild.innerText = fields[i];
		input.firstElementChild.nextElementSibling.id = fields[i];
		input.firstElementChild.nextElementSibling.name = fields[i];
		feild_list.appendChild(input);
	}
}

// addEventListener to proxy_status textarea
var proxy_status=document.querySelector('#proj_detail #proxy_status');
if(proxy_status) {
	if(! proxy_status.disabled)
	proxy_status.addEventListener("change", post_proxy_status);
	proxy_status.addEventListener("input", enableBtn);
	//proxy_status.addEventListener("input", enableBtn, {once: true});
}

function enableBtn() {
	let text = document.getElementById('proxy_status_btn_text');
	let btn = document.getElementById('proxy_status_btn');
    btn.disabled = false;
    text.innerText = "提 交";
	proxy_status.removeEventListener("input", enableBtn);
}

function post_proxy_status() {
    var v = this.value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                //console.log(xhr.response);
                setTimeout(function () {
                    spinner.classList.remove('spinner-border');
                    spinner.classList.remove('spinner-border-sm');
                    btn.disabled = true;
                    text.innerText = "已保存";
					proxy_status.addEventListener("input", enableBtn);
					//proxy_status.addEventListener("input", enableBtn, {once: true});
                }, 200);
            }
        }
    };
    xhr.open('POST', '/fgw/ajax/update_proxy_status.php');
    //xhr.responseType='json';
    xhr.responseType='text';
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("proxy_status=" + v + "&pid=" + document.getElementById('pid').placeholder);
    let spinner = document.getElementById('proxy_status_btn_spin');
    let text = document.getElementById('proxy_status_btn_text');
    let btn = document.getElementById('proxy_status_btn');
    spinner.classList.add('spinner-border');
    spinner.classList.add('spinner-border-sm');
}

// addEventListener to projects list
var projects=document.querySelectorAll('#projects tbody tr');
for(var i=0;i<projects.length;i++){
    projects[i].addEventListener("click", progressPage);
}
// click on projects entries to progress page
function progressPage(){
    var pid=this.querySelector('th').innerText.trim();	// why trim(), because fucking qq browser appends a fucking tab to innerText
    //var href=location.pathname.replace(/\/+$/, '') + "/" + pid;
    var href="/fgw/project/" + pid;
    if(parent===window){
        location.pathname = href;
    }
    else{
        chParentHref(href.replace('/fgw',''));
    }
}

// addEventListener to users list
var projects=document.querySelectorAll('#userlist tbody tr');
for(var i=0;i<projects.length;i++){
    projects[i].addEventListener("click", moduser);
}
// click on users entries to moduser page
function moduser(){
    var user=this.querySelector('td').innerText;
    var href = '/fgw/admin/user/' + user;
    location.pathname = href;
}

// click on users entries to passwd page
function passwd(){
    var user=this.querySelector('td').innerText;
    var href = location.pathname + '/../chpwd/' + user;
    //console.log(href);
    if(parent===window){
        location.pathname = href;
    }
    else{
        chParentHref(href.replace('/fgw',''));
    }
    //var user1=document.querySelector('input').innerText;
    //console.log(user1);
}

// addEventListener to alertclosebtn
var alertclosebtn=document.getElementsByClassName('close');
for(var i=0;i<alertclosebtn.length;i++){
    alertclosebtn[i].addEventListener("click", closealert);
}
// close alerts
function closealert(){
    var i=this.parentElement
    i.classList.remove('show');
    setTimeout(function(){i.classList.add('d-none')}, 150);
    // set sth so this alert won't come out again when refresh
}

// addEventListener to dropdownbtn
var dropdownbtn=document.querySelectorAll('.dropdown button');
for(var i=0;i<dropdownbtn.length;i++){
    dropdownbtn[i].addEventListener("click", dropdown);
    //dropdownbtn[i].addEventListener("focusout", dropdown);
    dropdownbtn[i].addEventListener("blur", dropdownHide);
}
var dropdownlink=document.getElementsByClassName('dropdown-link');
for(var i=0;i<dropdownlink.length;i++){
    dropdownlink[i].removeEventListener('blur', dropdownHide);
}

// toggle dropdown menu
function dropdown(){
    // add class show to .dropdown
    this.parentElement.classList.toggle('show');
    // add class show to .dropdown-menu
    this.nextElementSibling.classList.toggle('show');
    // change aria-expanded value to true
    //console.log(this.getAttribute('aria-expanded'));
    //this.getAttribute('aria-expanded')=='true' ? this.setAttribute('aria-expanded', 'false') : this.setAttribute('aria-expanded', 'true');
}
function dropdownHide(){
    // add class show to .dropdown
    this.parentElement.classList.remove('show');
    // add class show to .dropdown-menu
    this.nextElementSibling.classList.remove('show');
}

// addEventListener to dropdown-item
var dropdownitem=document.querySelectorAll('.dropdown-menu .dropdown-item');
for(var i=0;i<dropdownitem.length;i++){
    dropdownitem[i].addEventListener("mousedown", dropdownmenu);
}
// dropdown menu
function dropdownmenu(){
    for(var i=0;i<dropdownitem.length;i++){
        dropdownitem[i].classList.remove('active');
    }
    this.classList.add('active');
    this.parentElement.previousElementSibling.innerHTML=this.innerHTML;
}

// addEventListener to #dates .dropdown-item
var datesDropdownitem=document.querySelectorAll('#dates .dropdown-menu .dropdown-item');
for(var i=0;i<datesDropdownitem.length;i++){
    datesDropdownitem[i].addEventListener("mousedown", toggleWritable);
}

// toggle input wirtable and submit btn visibility in progress page
function toggleWritable(){
    var input=document.querySelectorAll('.writable');
    var submit=document.querySelector('button[type=submit]');
    var yellow=document.getElementsByClassName('dup');
    //console.log(yellow);
    if(this!==document.getElementById('dates').querySelector('.dropdown-menu').firstElementChild){
        //console.log(this);
        // disable inputs
        for(var i=0;i<input.length;i++){
            input[i].setAttribute("disabled","");
            //input[i].setAttribute("readonly","");
        }
        // hide submit
        if(submit) submit.classList.add("d-none");
        // remove yellow color
        for(var i=0;i<yellow.length;i++){
            yellow[i].classList.remove('table-warning');
        }
    }
    else {
        // enable inputs
        for(var i=0;i<input.length;i++){
            input[i].removeAttribute("disabled");
            //input[i].removeAttribute("readonly");
        }
        // show submit
        if(submit) submit.classList.remove("d-none");
        // recover yellow color
        for(var i=0;i<yellow.length;i++){
            yellow[i].classList.add('table-warning');
        }
    }

    // ajax data of selected month
    var xhr =new XMLHttpRequest();
    xhr.onreadystatechange = updateform;
    xhr.open('POST', '/fgw/ajax/getform.php');
    xhr.responseType='json';
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("month=" + this.innerText + "&pid=" + document.getElementById('pid').placeholder);

    function updateform(){
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                var x = xhr.response;
                var nodata = document.getElementById('nodata');
                //console.log(x);
                if(x){
                    document.getElementById('fillby').placeholder=x.fillby;
                    document.getElementById('phone').placeholder=x.phone;
                    document.getElementById('invest_mon').placeholder=x.invest_mon;
                    document.getElementById('problem').placeholder=x.problem;
                    document.getElementById('problem').innerText=x.problem;
                    document.getElementById('prog').placeholder=x.progress;
                    document.getElementById('prog').innerText=x.progress;
                    document.getElementById('progress_from_jan').placeholder=x.progress_from_jan;
                    document.getElementById('progress_from_jan').innerText=x.progress_from_jan;
                    document.getElementById('next_step').placeholder=x.next_step;
                    document.getElementById('next_step').innerText=x.next_step;
                    // hide alert 'don't have data of selected month'
                    nodata.classList.add('d-none');
                }
                else{
                    // alert 'don't have data of selected month'
                    //console.log(this);
                    //nodata.firstChild.textContent='没有' + this.innerText + '的数据';
                    nodata.classList.remove('d-none');
                    nodata.classList.add('show');

                    document.getElementById('fillby').placeholder='';
                    document.getElementById('phone').placeholder='';
                    document.getElementById('invest_mon').placeholder='';
                    document.getElementById('problem').placeholder='';
                    document.getElementById('problem').innerText='';
                    document.getElementById('prog').placeholder='';
                    document.getElementById('prog').innerText='';
                    document.getElementById('progress_from_jan').placeholder='';
                    document.getElementById('progress_from_jan').innerText='';
                    document.getElementById('next_step').placeholder='';
                    document.getElementById('next_step').innerText='';
                }
            }
        }

    }
}

// addEventListener to search
var s=document.getElementById('search');
var c=document.getElementById('clearsearch');
if(s) s.addEventListener('keyup', search);
// search
function search(){
    if(s){
        // value of input
        //var v=s.firstElementChild.value;
        var v=s.value;
        // if v is not empty, show clear icon
        if(v){c.classList.remove('d-none');
        }
        else{
            c.classList.add('d-none');
        }
    }

    var tr=document.getElementsByClassName('searchable');

    // search v in every tr
    for(var i=0;i<tr.length;i++){
        // search v in every td
        for(var j=tr[i].firstElementChild;j;j=j.nextElementSibling){
            // if v is not in j.innerText. NOTE: indexOf(v) returns 0 if v is empty
            if(j.innerText.indexOf(v) !== -1){
                tr[i].classList.remove('d-none');
                j=1; // if find any, j is no longer useful, so we can use it as a switch
                break;
            }
        }
        if(j!==1) tr[i].classList.add('d-none');
    }
}

// addEventListener to clearsearch
if(c) c.addEventListener('click', clearsearch);
function clearsearch(){
    s.value="";
    s.focus();
    search();
}

// addEventListener to #projects .dropdown-item
var pjDropdownitem=document.querySelectorAll('#type_menu .dropdown-item');
for(var i=0;i<pjDropdownitem.length;i++){
    pjDropdownitem[i].addEventListener("mousedown", searchType);
}

function searchType(i){
    var tr=document.getElementsByClassName('searchable');
    if(i==1){
        i=document.getElementById('type_btn');
    }
    else{
        i=this;
    }
    var type=i.firstChild.textContent.replace(/ /g,'');
    // console.log(type);
    for(var i=0;i<tr.length;i++){
        if(type == tr[i].getAttribute('data-type') || type == '所有类型'){
            tr[i].classList.remove('d-none');
        }
        else{
            tr[i].classList.add('d-none');
        }
    }
}

function countType(){
    var tr=document.getElementsByClassName('searchable');
    var type=document.getElementsByClassName('count');
    // every type
    for(var i=0;i<type.length;i++){
        type[i].innerText = document.querySelectorAll(".searchable[data-type='" + type[i].previousSibling.textContent.replace(/ /g,'') + "']").length;
    }
    // all types
    allType = document.getElementsByClassName('count_all');
    for(var i=0;i<allType.length;i++){
        allType[i].innerText = tr.length;
    }
}

var myProj=document.getElementById('myproject');
if(myProj){
    // count my projs;
    var myOid=myProj.getAttribute('data-oid');
    countMy = document.querySelectorAll('tr[data-oid="' + myOid + '"]').length;
    document.getElementById('count_my').innerText = countMy;
    // count type
    //count_all = document.getElementsByClassName('count_all')[0];
    //count_type_a= document.getElementsByClassName('count_type_a')[0];
    //count_type_b= document.getElementsByClassName('count_type_b')[0];
    //count_type_c= document.getElementsByClassName('count_type_c')[0];
    //count_type_d= document.getElementsByClassName('count_type_d')[0];

    //count_all.innerText = '';
    //count_type_a.innerText = '';
    //count_type_b.innerText = '';
    //count_type_c.innerText = '';
    //count_type_d.innerText = '';

    countType();
    // addEventListener to #myproject
    myProj.addEventListener('click', toggleMy);
}
// toggle my projects
function toggleMy(){
    this.classList.toggle('btn-outline-info');
    this.classList.toggle('btn-info');


    // tr(s) that "data-oid" attribute NOT equal to myOid
    var selector='table tbody tr:not([data-oid="' + myOid + '"])';
    var tr=document.querySelectorAll(selector);
    //console.log(tr);

    // search oid in every tr's data-oid
    for(var i=0;i<tr.length;i++){
        if(this.classList.contains('btn-info')){
            tr[i].classList.add('d-none');
            tr[i].classList.remove('searchable');
        }
        else{
            tr[i].classList.remove('d-none');
            tr[i].classList.add('searchable');
        }
    }
    countType();
    searchType(1);
    if (s && s.value) {
        search(); // to filter
    }
}

// addEventListener to upload
var u=document.querySelector('#upload input');
if(u) u.addEventListener('change', chname);
function chname(){
    u.nextElementSibling.innerText=u.value;
}

// addEventListener to monthpicker
var m=document.getElementsByClassName('pickmonth');
for(var i=0;i<m.length;i++){
    //m[i].addEventListener("click", pickmonth);
    //m[i].addEventListener("blur", function(){ pickmonth(1, m[i]); });
}
function pickmonth(i){
    if(i===1){
        //var m=document.querySelectorAll('.pickmonth');
        //console.log(this);
        //console.log(m);
        //m.nextElementSibling.classList.add('d-none');
        //var m=document.getElementsByClassName('monthpicker');
        //for(var i=0; i<m.length; i++)
        //	m[i].classList.add('d-none');
        //console.log(this);
        return;
    }
    if(! this.hasAttribute('readonly')){
        if(! this.nextElementSibling){
            var html=document.getElementById('monthpicker').cloneNode(true);
            html.className="position-absolute monthpicker";
            html.removeAttribute('id');
            this.parentElement.appendChild(html);
        }
        else{
            this.nextElementSibling.classList.remove('d-none');
        }
    }
}

// addEventListener to login password
var p=document.getElementById('inputPassword');
if(p) p.addEventListener("keyup", encrytpass);
function  encrytpass(){
    //console.log(md5('1'));
    //console.log(p.value);
    //p.value=(md5(p.value));
}

// addEventListener to img thumbnails
var thumb=document.getElementsByClassName('img-fluid');
for(var i=0;i<thumb.length;i++){
    thumb[i].addEventListener("click", showImg);
}
function showImg(){
    var d = document.getElementById('popimg');
    d.firstElementChild.src=this.src.replace('thumb/','');
    d.classList.remove('d-none');
    d.classList.add('show');
    layer.classList.remove('d-none');
    layer.classList.add('show');
    d.setAttribute('style', 'margin-left: ' + -d.clientWidth/2 +'px; margin-top:' + -d.clientHeight/2 + 'px;');
}

// addEventListener to popimgclose btn
var popimgclose=document.getElementById('popimgclose');
if(popimgclose) popimgclose.addEventListener('click', closelayer);
// addEventListener to layer
var layer=document.getElementById('layer');
if(layer) layer.addEventListener('click', closelayer);
// close opacity layer
function closelayer(){
    layer.classList.remove('show');
    setTimeout(function(){layer.classList.add('d-none')}, 150);
    popimgclose.click();
}

// some jquery
if(m.length > 0){
    $('.pickmonth').datepicker({
        format: 'yyyy-mm',
        minViewMode: 1,
        language: "zh-CN",
        autoclose: true
    });
}

//var a = document.getElementsByTagName('a');
//for(var i=0; i<a.length; i++){
//	if(a[i].href!==0){
//		//a[i].addEventListener('click', callParent);
//	}
//}

function callParent(){
    //parent.postMessage(location.pathname, '*');
    var h=this.href;
    var hh=h.slice(h.indexOf('fgw')+3);
    //console.log(hh);
    parent.postMessage(hh, '*');
}
function chParentHref(path){
    parent.postMessage(path, '*');
}

// addEventListener to btn in 404
var backbtn = document.querySelector('#notfound button');
if(backbtn) backbtn.addEventListener("click", function(){history.back()});

function tdToObject(){
    var a = document.getElementsByTagName('tr');
    o={};
    for (var i=0; i<a.length; i++) {
        o[i]=[];
        if (i == 0) {
            var b = a[i].getElementsByTagName('th');
        }
        else {
            var b = a[i].getElementsByTagName('td');
        }
        for (var j=0; j<b.length; j++){
            o[i][j] = b[j].innerText;

        }
    }
}
// addEventListener to #exportbtn
var expbtn = document.getElementById('exportbtn');
if(expbtn) expbtn.addEventListener("click", tbl2xlsx);

function tbl2xlsx(){
    var tbl = document.getElementById('report_table');
    var filename= document.getElementById('reportbtn').getElementsByClassName('active')[0].innerText;

    if (filename == '进度月报') {
        tbl = tbl.cloneNode(true);
        var tr = tbl.getElementsByClassName('d-none');
        var l = tr.length;
        for (var i=0; i < l; i++){
            if (tr[0]) tr[0].remove();
        }

        var month = document.getElementById('month').innerText.trim();
        filename = month;
        var b1 = document.getElementById('myproject');
        if (b1.classList.contains('btn-info')) {
            filename += '我的';
        }
        var b2 = document.getElementById('type_btn');
        if (b2.firstElementChild.classList.contains('count')) {
            filename += b2.firstChild.textContent.replace(/ /g, '') + '类';
        }
        filename += '进度月报';
    }

    // write workbook
    //var wb = XLSX.utils.table_to_book(tbl, {sheet: sheetname});
    var wb = XLSX.utils.table_to_book(tbl);

    if (filename == '统计汇总') {
        // rename first sheet's name. don't know how to rename, so clone a new element
        var sheetname = tbl.firstElementChild.firstElementChild.firstElementChild.innerText;
        wb.Sheets[sheetname] = wb.Sheets[wb.SheetNames[0]];
        wb.SheetNames[0] = sheetname;

        while (tbl){
            tbl.id="";
            tbl = document.getElementById('report_table');
            if (tbl){
                // append a sheet to workbook
                var ws = XLSX.utils.table_to_sheet(tbl);
                sheetname = tbl.firstElementChild.firstElementChild.firstElementChild.innerText;
                XLSX.utils.book_append_sheet(wb, ws, sheetname);
            }
        }
    }

    var t = new Date();
    var date = '';
    date += t.getFullYear()
        + ('0' + (t.getMonth() + 1)).slice(-2)
        + ('0' + t.getDate()).slice(-2)
        + ('0' + t.getHours()).slice(-2)
        + ('0' + t.getMinutes()).slice(-2)
        + ('0' + t.getSeconds()).slice(-2);
    filename += '_' + date + '.xlsx' ;

    XLSX.writeFile(wb, filename ,{bookType: "xlsx"});
}

// addEventListener to #nav-tab .nav-item
var navitems = document.getElementsByClassName('nav-item');
var tabpanes = document.getElementsByClassName('tab-pane');
if(navitems) {
    for (var i=0;i<navitems.length; i++){
        navitems[i].addEventListener("click", shownavitem);
    }
}

function shownavitem(){
    //active tab;
    for (var i=0;i<navitems.length; i++){
		if (navitems[i] === this) {
			navitems[i].classList.add('active');
			tabpanes[i].classList.add('show');
			tabpanes[i].classList.add('active');
		}
		else {
			navitems[i].classList.remove('active');
			tabpanes[i].classList.remove('show');
			tabpanes[i].classList.remove('active');
		}
    }
}

let detail = document.getElementById('proj_detail');
if (detail){
    hash = location.hash.replace('#', '');
    for (var i=0;i<navitems.length; i++){
        if(! hash){
            hash = 'progress';
			location.href += '#' + hash;
        }
        if (tabpanes[i].dataset.name != hash) {
            navitems[i].classList.remove('active');
            tabpanes[i].classList.remove('show');
            tabpanes[i].classList.remove('active');
        }
        else {
            navitems[i].classList.add('active');
            tabpanes[i].classList.add('show');
            tabpanes[i].classList.add('active');
        }
    }
}

// addEventListener to .procradio
var radioProc = document.getElementsByClassName('procradio');
if(radioProc) {
    for (var i=0;i<radioProc.length; i++) {
        // if is disabled, don't attach listener, otherwise a click will submit data even it looks like disabled
        if(radioProc[i].firstElementChild.disabled == false){
            radioProc[i].addEventListener("click", updateProc);
        }
    }
}

function updateProc(){
    // var pid;
    var code = this.firstElementChild.getAttribute('name');
    var v = this.firstElementChild.id.replace(code + '-', '');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                //console.log(xhr.response);
                setTimeout(function () {
                    spinner.classList.remove('spinner-border');
                    spinner.classList.remove('spinner-border-sm');
                }, 200);
            }
        }
    };
    xhr.open('POST', '/fgw/ajax/updateproc.php');
    xhr.responseType='json';
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("v=" + v + "&code=" + code + "&pid=" + document.getElementById('pid').placeholder);
    //console.log(this);
    let spinner = this.parentElement.lastElementChild;
    spinner.classList.add('spinner-border');
    spinner.classList.add('spinner-border-sm');
}

let tab
