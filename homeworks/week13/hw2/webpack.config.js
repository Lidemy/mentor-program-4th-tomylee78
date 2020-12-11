const path = require('path');

module.exports = {
    mode: 'development',
    entry: './api_index.js',
    output: {
        path: path.resolve(__dirname),
        library: 'commentsPlugin',
        filename: 'commentPlugin.js',
    },
};
