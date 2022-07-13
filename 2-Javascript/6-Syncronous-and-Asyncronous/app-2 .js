const  button = document.getElementById ("button");
button.addEventListener('click',loadData);
function loadData () {
    const xhr = new XMLHttpRequest();
    console.log('READYSTATE', xhr.readyState);
    xhr.open('GET','data.txt',true);
    xhr.onprogress = function(){
     
    }
}