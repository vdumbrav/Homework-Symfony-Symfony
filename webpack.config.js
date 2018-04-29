/* подключим плагин */
var Encore = require('@symfony/webpack-encore');

Encore
/* Установим путь куда будет осуществляться сборка */
    .setOutputPath('public/build/')
    /* Укажем web путь до каталога web/build */
    .setPublicPath('/build')
    /* Каждый раз перед сборкой будем очищать каталог /build */
    .cleanupOutputBeforeBuild()

   // jquery
   .autoProvidejQuery()

    /* Включим поддержку sass/scss файлов */
    .enableSassLoader()
    /* --- Добавим основной JavaScript в сборку --- */
    .addEntry('js/app', './assets/js/app.js')

    /* Добавим наш главный файл ресурсов в сборку */
    .addStyleEntry('css/app', './assets/scss/app.scss')

    /* В режиме разработки будем генерировать карту ресурсов */
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction());

/* Экспортируем финальную конфигурацию */
var config = Encore.getWebpackConfig();

//disable amd loader
config.module.rules.unshift({
    parser: {
        amd: false,
    }
});

module.exports = config;