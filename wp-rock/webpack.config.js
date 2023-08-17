/* eslint-disable @typescript-eslint/no-var-requires */
/**
 * This is a main entrypoint for Webpack config.
 *
 * @since 1.0.0
 */
const path = require('path');

// Paths to find our files and provide BrowserSync functionality.
const projectPaths = {
    projectDir: __dirname, // Current project directory absolute path.
    projectJsPath: path.resolve(__dirname, 'src/js'),
    projectScssPath: path.resolve(__dirname, 'src/scss'),
    projectImagesPath: path.resolve(__dirname, 'src/images'),
    projectOutput: path.resolve(__dirname, 'assets/public'),
    projectWebpack: path.resolve(__dirname, 'webpack'),
    projectFontsPath: path.resolve(__dirname, 'assets/public/fonts'),
};

// Files to bundle
const projectFiles = {
    // BrowserSync settings
    browserSync: {
        enable: true, // enable or disable browserSync
        host: 'localhost',
        port: 3000,
        mode: 'server', // proxy | server
        server: { baseDir: ['public'] }, // can be ignored if using proxy
        // BrowserSync will automatically watch for changes to any files connected to our entry,
        // including both JS and Sass files. We can use this property to tell BrowserSync to watch
        // for other types of files, in this case PHP files, in our project.
        files: '**/**/**.php',
        reload: true, // Set false to prevent BrowserSync from reloading and let Webpack Dev Server take care of this
        // browse to http://localhost:3000/ during development,
    },

    // JS configurations for development and production
    projectJs: {
        eslint: true, // enable or disable eslint  | this is only enabled in development env.
        filename: 'js/[name].js',
        entry: {
            frontend: `${projectPaths.projectJsPath}/frontend.ts`,
            backend: `${projectPaths.projectJsPath}/backend.ts`,

            'page-single-post': `${projectPaths.projectScssPath}/parts/page-single-post.scss`,
            'page-404': `${projectPaths.projectScssPath}/parts/404.scss`,
            'wc-checkout': `${projectPaths.projectScssPath}/parts/wc-checkout.scss`,

            'block-hero': `${projectPaths.projectJsPath}/acf-blocks/block-hero.js`,
            'block-banner': `${projectPaths.projectScssPath}/acf-blocks/block-banner.scss`,
            'block-blog-filters': `${projectPaths.projectScssPath}/acf-blocks/block-blog-filters.scss`,
            'block-blog-posts': `${projectPaths.projectScssPath}/acf-blocks/block-blog-posts.scss`,
            'block-loyalty-program-banner': `${projectPaths.projectScssPath}/acf-blocks/block-loyalty-program-banner.scss`,
            'block-loyalty-program': `${projectPaths.projectScssPath}/acf-blocks/block-loyalty-program.scss`,
            'block-loyalty-banner': `${projectPaths.projectScssPath}/acf-blocks/block-loyalty-banner.scss`,
            'block-partners-logo-slider': `${projectPaths.projectJsPath}/acf-blocks/block-partners-logo-slider.js`,
            'block-external-news': `${projectPaths.projectScssPath}/acf-blocks/block-external-news.scss`,
            'block-partners-slider': `${projectPaths.projectJsPath}/acf-blocks/block-partners-slider.js`,
            'block-matches-list': `${projectPaths.projectScssPath}/acf-blocks/block-matches-list.scss`,
            'block-tiktok-videos': `${projectPaths.projectScssPath}/acf-blocks/block-tiktok-videos.scss`,
            'block-shop-now': `${projectPaths.projectScssPath}/acf-blocks/block-shop-now.scss`,
            'block-products-slider': `${projectPaths.projectJsPath}/acf-blocks/block-products-slider.js`,
            'block-timeline-slider': `${projectPaths.projectJsPath}/acf-blocks/block-timeline-slider.js`,
            'block-faqs': `${projectPaths.projectScssPath}/acf-blocks/block-faqs.scss`,
            'block-contact-us': `${projectPaths.projectScssPath}/acf-blocks/block-contact-us.scss`,
            'block-content': `${projectPaths.projectScssPath}/acf-blocks/block-content.scss`,
            'block-banner-v2': `${projectPaths.projectScssPath}/acf-blocks/block-banner-v2.scss`,
            'block-history-and-achievements': `${projectPaths.projectJsPath}/acf-blocks/block-history-and-achievements.js`,
            'block-our-team': `${projectPaths.projectScssPath}/acf-blocks/block-our-team.scss`,
            'block-cta-section': `${projectPaths.projectScssPath}/acf-blocks/block-cta-section.scss`,
            'block-loyalty-benefits': `${projectPaths.projectJsPath}/acf-blocks/block-loyalty-benefits.js`,
            'block-league-table': `${projectPaths.projectJsPath}/acf-blocks/block-league-table.js`,
            'block-image-gallery': `${projectPaths.projectJsPath}/acf-blocks/block-image-gallery.js`,
            'block-text-content': `${projectPaths.projectScssPath}/acf-blocks/block-text-content.scss`,
            'block-sponsors-list': `${projectPaths.projectScssPath}/acf-blocks/block-sponsors-list.scss`,
            'block-live-stream': `${projectPaths.projectScssPath}/acf-blocks/block-live-stream.scss`,
            'block-latest-news': `${projectPaths.projectScssPath}/acf-blocks/block-latest-news.scss`,
        },
        rules: {
            // test: /\.m?js$/,
            test: /\.tsx?$/,
        },
        options: {
            configFile: path.resolve('./tsconfig.json'),
        },
    },

    // CSS configurations for development and production
    projectCss: {
        postCss: `${projectPaths.projectWebpack}/postcss.config.js`,
        stylelint: true, // enable or disable stylelint | this is only enabled in development env.
        filename: 'css/[name].css',
        use: 'sass', // sass || postcss
        // ^ If you want to change from Sass to PostCSS or PostCSS to Sass then you need to change the
        // styling files which are being imported in "assets/src/js/frontend.js" and "assets/src/js/backend.js".
        // So change "import '../sass/backend.scss'" to "import '../postcss/backend.pcss'" for example
        rules: {
            sass: {
                test: /\.s[ac]ss$/i,
            },
            postcss: {
                test: /\.pcss$/i,
            },
        },
        /* purgeCss: {
            // PurgeCSS is only being activated in production environment
            paths: [
                // Specify content that should be analyzed by PurgeCSS
                `${__dirname}/assets/src/js/!**!/!*`,
                `${__dirname}/templates/!**!/!**!/!*`,
                `${__dirname}/template-parts/!**!/!**!/!*`,
                `${__dirname}/blocks/!**!/!**!/!*`,
                `${__dirname}/!*.php`,
            ],
        }, */
    },

    // Source Maps configurations
    projectSourceMaps: {
        // Sourcemaps are nice for debugging but takes lots of time to compile,
        // so we disable this by default and can be enabled when necessary
        enable: true,
        env: 'dev', // dev | dev-prod | prod
        // ^ Enabled only for development on default, use "prod" to enable only for production
        // or "dev-prod" to enable it for both production and development
        devtool: 'source-map', // type of sourcemap, see more info here: https://webpack.js.org/configuration/devtool/
        // ^ If "source-map" is too slow, then use "cheap-source-map" which struck a good balance between build performance and debuggability.
    },
    // Images configurations for development and production
    projectImages: {
        rules: {
            test: /\.(jpe?g|png|gif|svg)$/i,
        },
        // Optimization settings
        minimizerOptions: {
            // Lossless optimization with custom option
            // Feel free to experiment with options for better result for you
            // More info here: https://webpack.js.org/plugins/image-minimizer-webpack-plugin/
            plugins: [
                ['gifsicle', { interlaced: true }],
                ['jpegtran', { progressive: true }],
                ['optipng', { optimizationLevel: 5 }],
                [
                    'svgo',
                    {
                        plugins: [{ removeViewBox: false }],
                    },
                ],
            ],
        },
    },
};

// Merging the projectFiles & projectPaths objects
const projectOptions = {
    ...projectPaths,
    ...projectFiles,
    projectConfig: {
        // add extra options here
    },
};

// Get the development or production setup based
// on the script from package.json
module.exports = (env) => {
    if (env.NODE_ENV === 'production') {
        return require('./webpack/config.production')(projectOptions);
    }
    return require('./webpack/config.development')(projectOptions);
};
