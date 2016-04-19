/*$Id: objfuncoes.js 23965 2013-11-20 15:44:43Z leandroe $*/

//conta inputs e selects com o mesmo nome ex: nome[]
function total_objetos(form_nome,obj_nome) {
  var f=document.getElementById(form_nome);
  var o,i=0,x=0;
  while(x<f.length) {
	  o=f.elements[x];
	  if(o.id==obj_nome)i++;
	  x++;
  }
  return i;
}

function total_objetos_tag(form_nome,tag,obj_nome) {
  var f=document.getElementById(form_nome);
  var o,i=0,x=0,q=0,m;
  m=f.getElementsByTagName(tag);
  q=m.length;
  while(x<q) {
	  o=m[x];
	  if(o.id==obj_nome)i++;
	  x++;
  }
  return i;
}


//retorna o elemento obj_indice dos inputs e selects com mesmo nome
function objeto(form_nome,obj_nome,obj_indice) {
  var f=document.getElementById(form_nome);var o,i=0,q=f.length;
  var x=0;while(x<q) {
	  o=f.elements[x];
	  if(o.id==obj_nome) {
		 if(i==obj_indice)return o;
		 i++;
	  }
	  x++;
  }
  return null;
}



//retorna o elemento obj_indice com a tag indicada com mesmo nome
function objeto_tag(form_nome,obj_nome,tag,obj_indice) {
  var f=document.getElementById(form_nome);var o,i=0,q=0,m;
  m=f.getElementsByTagName(tag);
  q=m.length;
  var x=0;
  while(x<q) {
	  o=m[x];
	  if(o.id==obj_nome) {
		 if(i==obj_indice) {
			return o;
		 }
		 i++;
	  }
	  x++;
  }
  return null;
}


function objeto_nome(nm,id) {
	var l=document.getElementsByName(nm);
	return l[id];
}

//limpar todos os itens do drop menos o primeiro
function limpa_drop(obj) {
  while(obj.length>1) {obj.remove(1);}
}

//limpar todos os itens do drop menos o primeiro
function total_limpa_drop(obj) {
  while(obj.length>0) {obj.remove(0);}
}

//inclui os itens de uma matriz no drop
function preencher_drop(wd,obj,valores,rotulos) {
  var op,x=0,y=valores.length;
  if(rotulos[x]!='SELECIONE') {
	  op = wd.document.createElement("option");
	  op.text = 'SELECIONE';
	  op.value = '';
	  obj.options.add(op);
  }
  while(x<y) {
	  op = wd.document.createElement("option");
	  op.text = rotulos[x];
		if(valores[x]=='disabled') {
  	  op.value = '';
  	  op.disabled=true;
      obj.options.add(op);

		}else{
  	  op.value = valores[x];
      obj.options.add(op);
		}
	  x++;
  }
}

//inclui os itens de uma matriz no drop
function preencher_opcional_drop(wd,obj,valores,rotulos) {
  var op,opi,x=0,y=valores.length;
  opi = wd.document.createElement("option");
  opi.text = 'Carregando...';
  opi.value = '';
  obj.options.add(opi);
  while(x<y) {
	  op = wd.document.createElement("option");
	  op.text = rotulos[x];
  	  op.value = valores[x];
      obj.options.add(op);
	  x++;
  }
  obj.options[0].text='';
}


//informe o valor do option a ser selecionado
function seleciona_option(obj,valor) {
  var x=0,op;
  while(x<obj.length) {
	op=obj.options[x];
	if(op.value==valor) {
	  obj.selectedIndex=x;
	  return true;
	}
    x++;
  }
  return false;
}

//desaviva os objetos cujos noves estao na matriz mt
function desativar_campos(mt) {
  var x=0,o;
  while(x<mt.length) {
	o=document.getElementById(mt[x]);
	if(o!=null) {o.disabled=true;}
    x++ ;
  }
}

function ativar_campos(mt) {
  var x=0,o;
  while(x<mt.length) {
	o=document.getElementById(mt[x]);
	if(o!=null) {o.disabled=false;}
    x++ ;
  }
}

function form_get(nm, callback) {
  var l='',ll='',s='',f=document.getElementById(nm),o,x,v='',n,mm;
  if(typeof f  === 'undefined' || f == null) {
  	e = new Array();
  } else {
  	e = f.elements;
  }
  for(x=0;x<e.length;x++) {
	  o=e[x];
    if(o.tagName=='INPUT' && (o.type=='checkbox' || o.type=='radio') ) {
		if(o.checked==true) {
		  if(l!='') {v='&';}
		  if(o.id=='')n=o.name;
		  else  n=o.id;
		  mm=o.value;
		  ll=ll+v+mm;
		  l=l+v+n+'='+URLencode(mm);
		}
	 }else{
		  if(l!='')v='&';
		  if(o.id=='')n=o.name;
		  else  n=o.id;

			if(o.tagName=='LABEL')s=o.innerHTML;
			else s=o.value;
			ll=ll+v+s;
			l=l+v+n+'='+URLencode(s);
	 }
  }
	e=document.getElementsByTagName('LABEL');
  for(x=0;x<e.length;x++) {
	    o=e[x];
		  if(l!='')v='&';
		  if(o.id=='')n=o.name;
		  else  n=o.id;
			s=o.innerHTML;
			ll=ll+v+s;
			l=l+v+n+'='+URLencode(s);
  }
  return l;
}



function form_array(nm,mt) {
  var l='',f=document.getElementById(nm),o,x,v='',n,lt=','+mt.toString()+',',nm;
  lt=lt.toUpperCase();
  if(typeof f  === 'undefined' || f == null) {
    e = new Array();
    alert("nao encontrado:"+nm);
  } else {
    e = f.elements;
  }
  for(x=0;x<e.length;x++) {
	 o=e[x];
	 nm=o.id;
	 if(nm.indexOf('[]')!=-1)nm=','+nm.substr(0,nm.length-2).toUpperCase()+',';
	 else nm=','+nm.toUpperCase()+',';
	 if(lt.indexOf(nm)!=-1 || lt.indexOf(nm)!=-1) {
		 if(o.tagName=='INPUT' && o.type=='checkbox') {
			if(o.checked==true) {
			  if(l!='') {v='&';}
			  if(o.id=='')n=o.name;
			  else  n=o.id;
			  l=l+v+n+'='+o.value;
			}
		 }else{
			  if(l!='')v='&';
			  if(o.id=='')n=o.name;
			  else  n=o.id;
			  l=l+v+n+'='+o.value;
		 }
	 }
  }
  return l;
}


function URLencode(st) {
	var x,ch,rt,lt;
	lt='';
	if(st) {
	for(x=0;x<st.length;x++) {
		ch=st.charAt(x);
		if(st.charCodeAt(x)==13)rt="%0D";
		else if(st.charCodeAt(x)==10)rt="%0A";
		else{
			switch(ch) {
				case "&": rt="%26";break;
				case "+": rt="%2b";break;
				case "\\": rt="%5c";break;
				case "^":rt="%5e";break;
				case "_":rt="%5f";break;
				case "`":rt="%60";break;


				case "~":rt="%7e";break;
				case "�":rt="%a1";break;
				case "�":rt="%a2";break;
				case "�":rt="%a3";break;
				case "�":rt="%a4";break;
				case "�":rt="%a5";break;
				case "�":rt="%a6";break;
				case "�":rt="%a7";break;
				case "�":rt="%a8";break;
				case "�":rt="%a9";break;
				case "�":rt="%aa";break;
				case "�":rt="%ab";break;
				case "�":rt="%ac";break;
				case "�":rt="%ad";break;
				case "�":rt="%ae";break;
				case "�":rt="%af";break;
				case "�":rt="%b0";break;
				case "�":rt="%b1";break;
				case "�":rt="%b2";break;
				case "�":rt="%b3";break;
				case "�":rt="%b4";break;
				case "�":rt="%b5";break;
				case "�":rt="%b6";break;
				case "�":rt="%b7";break;
				case "�":rt="%b8";break;
				case "�":rt="%b9";break;
				case "�":rt="%ba";break;
				case "�":rt="%bb";break;
				case "�":rt="%bc";break;
				case "�":rt="%bd";break;
				case "�":rt="%be";break;
				case "�":rt="%bf";break;
				case "�":rt="%c0";break;
				case "�":rt="%c1";break;
				case "�":rt="%c2";break;
				case "�":rt="%c3";break;
				case "�":rt="%c4";break;
				case "�":rt="%c5";break;
				case "�":rt="%c6";break;
				case "�":rt="%c7";break;
				case "�":rt="%c8";break;
				case "�":rt="%c9";break;
				case "�":rt="%ca";break;
				case "�":rt="%cb";break;
				case "�":rt="%cc";break;
				case "�":rt="%cd";break;
				case "�":rt="%ce";break;
				case "�":rt="%cf";break;
				case "�":rt="%d0";break;
				case "�":rt="%d1";break;
				case "�":rt="%d2";break;
				case "�":rt="%d3";break;
				case "�":rt="%d4";break;
				case "�":rt="%d5";break;
				case "�":rt="%d6";break;
				case "�":rt="%d7";break;
				case "�":rt="%d8";break;
				case "�":rt="%d9";break;
				case "�":rt="%da";break;
				case "�":rt="%db";break;
				case "�":rt="%dc";break;
				case "�":rt="%dd";break;
				case "�":rt="%de";break;
				case "�":rt="%df";break;
				case "�":rt="%e0";break;
				case "�":rt="%e1";break;
				case "�":rt="%e2";break;
				case "�":rt="%e3";break;
				case "�":rt="%e4";break;
				case "�":rt="%e5";break;
				case "�":rt="%e6";break;
				case "�":rt="%e7";break;
				case "�":rt="%e8";break;
				case "�":rt="%e9";break;
				case "�":rt="%ea";break;
				case "�":rt="%eb";break;
				case "�":rt="%ec";break;
				case "�":rt="%ed";break;
				case "�":rt="%ee";break;
				case "�":rt="%ef";break;
				case "�":rt="%f0";break;
				case "�":rt="%f1";break;
				case "�":rt="%f2";break;
				case "�":rt="%f3";break;
				case "�":rt="%f4";break;
				case "�":rt="%f5";break;
				case "�":rt="%f6";break;
				case "�":rt="%f7";break;
				case "�":rt="%f8";break;
				case "�":rt="%f9";break;
				case "�":rt="%fa";break;
				case "�":rt="%fb";break;
				case "�":rt="%fc";break;
				case "�":rt="%fd";break;
				case "�":rt="%fe";break;
				case "�":rt="%ff";break;
				default: rt=ch;
			}
		}
		lt=lt+rt;
	}
	}
	return lt;
}


function URLdecode(st) {
	var x,ch,rt,lt;
	lt='';
	if(st) {
	for(x=0;x<st.length;x++) {
		ch=st.substring(x,x+3);
		if(ch =="%0D")rt="\r";
		else if(ch == "%0A")rt="\n";
		else if(st.charAt(x) == "+")rt=" ";
		else{
			switch(ch) {
				case "%26": rt="&";break;
				case "%2B": rt="+";break;
				case "%5C": rt="\\";break;
				case "%5E":rt="^";break;
				case "%5F":rt="_";break;
				case "%60":rt="`";break;


				case "%7E":rt="~";break;
				case "%A1":rt="�";break;
				case "%A2":rt="�";break;
				case "%A3":rt="�";break;
				case "%A4":rt="�";break;
				case "%A5":rt="�";break;
				case "%A6":rt="�";break;
				case "%A7":rt="�";break;
				case "%A8":rt="�";break;
				case "%A9":rt="�";break;
				case "%AA":rt="�";break;
				case "%AB":rt="�";break;
				case "%AC":rt="�";break;
				case "%AD":rt="�";break;
				case "%AE":rt="�";break;
				case "%AF":rt="�";break;
				case "%B0":rt="�";break;
				case "%B1":rt="�";break;
				case "%B2":rt="�";break;
				case "%B3":rt="�";break;
				case "%B4":rt="�";break;
				case "%B5":rt="�";break;
				case "%B6":rt="�";break;
				case "%B7":rt="�";break;
				case "%B8":rt="�";break;
				case "%B9":rt="�";break;
				case "%BA":rt="�";break;
				case "%BB":rt="�";break;
				case "%BC":rt="�";break;
				case "%BD":rt="�";break;
				case "%BE":rt="�";break;
				case "%BF":rt="�";break;
				case "%C0":rt="�";break;
				case "%C1":rt="�";break;
				case "%C2":rt="�";break;
				case "%C3":rt="�";break;
				case "%C4":rt="�";break;
				case "%C5":rt="�";break;
				case "%C6":rt="�";break;
				case "%C7":rt="�";break;
				case "%C8":rt="�";break;
				case "%C9":rt="�";break;
				case "%CA":rt="�";break;
				case "%CB":rt="�";break;
				case "%CC":rt="�";break;
				case "%CD":rt="�";break;
				case "%CE":rt="�";break;
				case "%CF":rt="�";break;
				case "%D0":rt="�";break;
				case "%D1":rt="�";break;
				case "%D2":rt="�";break;
				case "%D3":rt="�";break;
				case "%D4":rt="�";break;
				case "%D5":rt="�";break;
				case "%D6":rt="�";break;
				case "%D7":rt="�";break;
				case "%D8":rt="�";break;
				case "%D9":rt="�";break;
				case "%DA":rt="�";break;
				case "%DB":rt="�";break;
				case "%DC":rt="�";break;
				case "%DD":rt="�";break;
				case "%DE":rt="�";break;
				case "%DF":rt="�";break;
				case "%E0":rt="�";break;
				case "%E1":rt="�";break;
				case "%E2":rt="�";break;
				case "%E3":rt="�";break;
				case "%E4":rt="�";break;
				case "%E5":rt="�";break;
				case "%E6":rt="�";break;
				case "%E7":rt="�";break;
				case "%E8":rt="�";break;
				case "%E9":rt="�";break;
				case "%EA":rt="�";break;
				case "%EB":rt="�";break;
				case "%EC":rt="�";break;
				case "%ED":rt="�";break;
				case "%EE":rt="�";break;
				case "%EF":rt="�";break;
				case "%F0":rt="�";break;
				case "%F1":rt="�";break;
				case "%F2":rt="�";break;
				case "%F3":rt="�";break;
				case "%F4":rt="�";break;
				case "%F5":rt="�";break;
				case "%F6":rt="�";break;
				case "%F7":rt="�";break;
				case "%F8":rt="�";break;
				case "%F9":rt="�";break;
				case "%FA":rt="�";break;
				case "%FB":rt="�";break;
				case "%FC":rt="�";break;
				case "%FD":rt="�";break;
				case "%FE":rt="�";break;
				case "%FF":rt="�";break;
				default: rt=st.charAt(x);
			}
		}
		if(rt != st.charAt(x) && st.charAt(x) != "+")
			x+=2;
		lt=lt+rt;
	}
	}

	return lt;
}

function existe_valor(valor,matriz_objeto) {
	var mt=document.getElementsByName(matriz_objeto);
	var q=mt.length;
	for(x=0;x<q;x++) {
		if (alltrim(mt[x].value)==alltrim(valor)) {
			 return true;
		}
	}
	return false;
}


function preencheu_algo(lstObj) {
	var mtobj=lstObj.split(","),x;
	var retorno=false;
	for(x=0;x<mtobj.length;x++) {
		if(alltrim(objid(mtobj[x]).value)!=='') {
			retorno=true;
		}
	}
	return retorno;
}
