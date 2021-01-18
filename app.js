var path = require('path');
var express = require('express');
var app = express();

app.get('/', (req, res) => {
    // res.send('Hello World!')
    res.sendFile(path.join(__dirname, "index.html"));
})
                                
var port = process.env.PORT || 3000;
app.listen(port, function () {
    console.log('[gilmarandrade.com] listening on port %s', port);
});