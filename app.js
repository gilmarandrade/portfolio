var path = require('path');
var express = require('express');
var app = express();

// app.get('/', (req, res) => {
//     // res.send('Hello World!')
//     res.sendFile(path.join(__dirname, "index.html"));
// })

// servindo arquivos estáticos
app.use(express.static(path.resolve(__dirname, "public")));

//Handle Production routes
if(process.env.NODE_ENV === 'production') {

    // // handle SPA
    // app.get("*", (req, res) => {// O wildcard '*' serve para servir o mesmo index.html independente do caminho especificado pelo navegador.
    //     res.sendFile(path.join(__dirname, "../public", "index.html"));
    // });
}

                                
var port = process.env.PORT || 3000;
app.listen(port, function () {
    console.log('[gilmarandrade.com] listening on port %s', port);
});