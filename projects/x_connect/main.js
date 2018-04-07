const electron = require('electron');
const app = electron.app;
const BrowserWindow = electron.BrowserWindow;

const path = require('path');
const url = require('url');
const fs = require('fs')

// var php = require("gulp-connect-php");
// php.server({
//     port: 8080,
//     base: path.resolve(__dirname) + '/projects/x_connect',
//     // this is now pointing to a possible local installation of php, that is best for portability
//     // feel free to change with a system-wide installed php, that is dirty & working, but less portable
//     bin: path.resolve(__dirname) + "c:\\xampp\\php\\php.exe"
// });

let mainWindow;

function createWindow () {
  mainWindow = new BrowserWindow();
  mainWindow.maximize();

  // mainWindow.setFullScreen(true);
  mainWindow.setFullScreen(false);
  mainWindow.setMenu(null);
  mainWindow.loadURL("http://localhost:8080/php/projects/x_connect/xconnect.php");
  // mainWindow.loadURL(url.format({
  //   pathname: path.join(__dirname, 'http://localhost:8080/php/projects/x_connect/xconnect.php'),
  //   protocol: 'file:',
  //   slashes: true
  // }));

  // Open the DevTools.
  mainWindow.webContents.openDevTools();


  mainWindow.on('closed', function () {
    mainWindow = null;
  });
}

app.on('ready', createWindow);

app.on('window-all-closed', function () {
  if (process.platform !== 'darwin') {
    app.quit();
  }
});

app.on('activate', function () {
  if (mainWindow === null) {
    createWindow();
  }
});
