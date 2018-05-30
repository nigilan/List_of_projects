var MongoClient = require('mongodb').MongoClient;
var configJson = require('../config/index');
module.exports = {
    getRecord : function (id,cb) {
        console.log();
        MongoClient.connect(configJson.mongodbUrl+configJson.mongoDatabase, function (err, db) {
            if (err) {
                cb(err,"");
                return;
            }
            
            const collection = db.collection(configJson.mongoCollection);
            
            collection.find({tid: parseInt(id)}).toArray(function (err, result) {
            if (err) {
                cb(err,"");
                return;
            }
            cb("", result);
            });
        });
    }
}