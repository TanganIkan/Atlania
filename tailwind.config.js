// tailwind.config.js
/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./node_modules/flowbite/**/*.js", // Wajib ada agar JS Flowbite terbaca
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Plus Jakarta Sans", "sans-serif"],
            },
        },
    },
    plugins: [
        require("flowbite/plugin"), // Wajib ada
    ],
};
