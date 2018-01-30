/* Generated by hostnet/webpack-bundle. Do not modify. */
var webpack = require('webpack');

var a = require("b");
var preLoader1 = require("pre-loader-1");
var preLoader2 = require("pre-loader-2");
var fn_extract_text_plugin_sass = require("extract-text-webpack-plugin");
module.exports = {

entry : {
    "a": "/path/to/a.js",
    "b": "/path/to/b.js"
},
output : {
    "a": "a",
    "b": "b",
    "c": "c",
    "path": "path/to/output"
},
resolve : {
    "root": {
        "a": "b",
        "b": "c"
    },
    "alias": {
        "a": "b",
        "b": "c",
        "c": "a"
    }
},
resolveLoader : {
    "root": "/path/to/node_modules"
},
plugins : [
    new webpack.DefinePlugin({"a":"b","b":"c"}), 
    new webpack.DefinePlugin({"c":"d","d":"e"}), 
    new fn_extract_text_plugin_sass("testfile", {allChunks: true})
],
module : {
    preLoaders : [
        { test: /\.css$/, loader: preLoader1.execute("a", "b") },
        { test: /\.less$/, loader: preLoader2.execute("c", "d") }
    ],
    loaders : [
        { test: /\.css$/, loader: "style!some-loader" },
        { test: /\.scss$/, loader: fn_extract_text_plugin_sass.extract("css!sass") }
    ],
    postLoaders : [
        { test: /\.inl$/, loader: "style" }
    ]
},
sassLoader: {
    includePaths: [
        'path1',
        'path2'
    ]
}
};
