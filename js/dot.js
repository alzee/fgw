// addEvnetListener to projects list
var projects=document.querySelectorAll('#projects tbody tr');
for(var i=0;i<projects.length;i++){
	projects[i].addEventListener("click", progressPage);
}
// click on projects entries to progress page
function progressPage(){
	var pid=this.querySelector('th').innerText;
	var href=location.pathname.replace(/\/+$/, '') + "/" + pid;
	//console.log(href);
	if(parent===window){
		location.pathname = href;
	}
	else{
		chParentHref(href.replace('/fgw',''));
	}
}

// addEvnetListener to users list
var projects=document.querySelectorAll('#setting tbody tr');
for(var i=0;i<projects.length;i++){
	projects[i].addEventListener("click", passwd);
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

// addEvnetListener to alertclosebtn
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

// addEvnetListener to dropdownbtn
var dropdownbtn=document.querySelectorAll('.dropdown button');
for(var i=0;i<dropdownbtn.length;i++){
	dropdownbtn[i].addEventListener("click", dropdown);
	//dropdownbtn[i].addEventListener("focusout", dropdown);
	dropdownbtn[i].addEventListener("blur", dropdown);
}
// toggle dropdown menu
function dropdown(){
	// add class show to .dropdown
	this.parentElement.classList.toggle('show');
	// add class show to .dropdown-menu
	this.nextElementSibling.classList.toggle('show');
	// change aria-expanded value to true
	//console.log(this.getAttribute('aria-expanded'));
	this.getAttribute('aria-expanded')=='true' ? this.setAttribute('aria-expanded', 'false') : this.setAttribute('aria-expanded', 'true');
}

// addEvnetListener to dropdown-item
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
	this.parentElement.previousElementSibling.innerText=this.innerText;
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
	xhr.open('POST', '/fgw/ajax.php');
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
					document.getElementById('prog').placeholder=x.progress;
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
					document.getElementById('prog').placeholder='';
				}
			}
			else{
			}
		}

	}
}

// addEvnetListener to search
var s=document.querySelector('#search');
if(s) s.addEventListener('keyup', search);
// search
function search(){
	// value of input
	//var v=s.firstElementChild.value;
	var v=s.value;

	var tr=document.querySelectorAll('.searchable');

	// search v in every tr
	for(var i=0;i<tr.length;i++){
		// search v in every td
		for(var j=tr[i].firstElementChild;j;j=j.nextElementSibling){
			if(j.innerText.indexOf(v) !== -1){
				tr[i].classList.remove('d-none');
				j=1; // if find any, j is no longer useful, so we can use it as a switch
				break;
			}
		}
		if(j!==1) tr[i].classList.add('d-none');
	}
}

// addEvnetListener to #myproject
var m=document.getElementById('myproject');
if(m) m.addEventListener('click', searchmy);
// searchmy
function searchmy(){
	this.classList.toggle('btn-outline-secondary');
	this.classList.toggle('btn-primary');

	var oid=this.getAttribute('data-oid');

	// tr(s) that "data-oid" attribute NOT equal to oid
	var selector='table tbody tr:not([data-oid="' + oid + '"])';
	var tr=document.querySelectorAll(selector);
	//console.log(tr);

	// search oid in every tr's data-oid
	for(var i=0;i<tr.length;i++){
		if(this.classList.contains('btn-primary')){
			tr[i].classList.add('d-none');
			tr[i].classList.remove('searchable');
		}
		else{
			tr[i].classList.remove('d-none');
			tr[i].classList.add('searchable');
			search(); // to filter
		}
	}
}

// addEvnetListener to upload
var u=document.querySelector('#upload input');
if(u) u.addEventListener('change', chname);
function chname(){
	u.nextElementSibling.innerText=u.value;
}

// addEvnetListener to monthpicker
var m=document.querySelectorAll('.pickmonth');
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

// addEvnetListener to login password
var p=document.getElementById('inputPassword');
if(p) p.addEventListener("keyup", encrytpass);
function  encrytpass(){
	//console.log(md5('1'));
	//console.log(p.value);
	//p.value=(md5(p.value));
}

// addEvnetListener to img thumbnails
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

// addEvnetListener to popimgclose btn
var popimgclose=document.getElementById('popimgclose');
if(popimgclose) popimgclose.addEventListener('click', closelayer);
// addEvnetListener to layer
var layer=document.getElementById('layer');
if(layer) layer.addEventListener('click', closelayer);
// close opacity layer
function closelayer(){
	layer.classList.remove('show');
	setTimeout(function(){layer.classList.add('d-none')}, 150);
	popimgclose.click();
}

// some jquery
$('.pickmonth').datepicker({
	format: 'yyyy-mm',
    minViewMode: 1,
    language: "zh-CN",
	autoclose: true
});

var a = document.getElementsByTagName('a');
for(var i=0; i<a.length; i++){
	if(a[i].href!==0){
		//a[i].addEventListener('click', callParent);
	}
}

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
