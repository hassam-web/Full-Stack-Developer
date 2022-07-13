const http = new EasyHttp;

//GET REQUEST
http.get("https://jsonplaceholder.typicode.com/posts")
.then(data=>console.log(data))
.catch(error=>console.log(error))

//POST REQUEST
const data = {
    title: 'Custom Post 2 ASDAS',
    body: 'This is a custom post 2 ASDASD'
};
http.post("https://jsonplaceholder.typicode.com/posts",data)
.then(data=>console.log(data))
.catch(error=>console.log(error))


//PUT REQUEST
const dataTwo = {
    title: 'Custom Post 2 ASDAS',
    body: 'This is a custom post 2 ASDASD'
};
http.put("https://jsonplaceholder.typicode.com/posts/1",dataTwo)
.then(data=>console.log(data))
.catch(error=>console.log(error))


//DELETE REQUEST
http.delete("https://jsonplaceholder.typicode.com/posts/1")
.then(data=>console.log(data))
.catch(error=>console.log(error))