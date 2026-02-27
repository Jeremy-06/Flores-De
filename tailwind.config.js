import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
                display: ["Playfair Display", "Georgia", "serif"],
            },
            colors: {
                rose: {
                    25: "#fff5f7",
                    750: "#9f1239",
                },
                gold: {
                    50: "#fffbeb",
                    100: "#fef3c7",
                    200: "#fde68a",
                    300: "#fcd34d",
                    400: "#fbbf24",
                    500: "#f59e0b",
                },
            },
            backgroundImage: {
                "gradient-radial": "radial-gradient(var(--tw-gradient-stops))",
                "hero-pattern":
                    "linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%)",
                "warm-gradient":
                    "linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%)",
                "rose-gradient":
                    "linear-gradient(135deg, #fecdd3 0%, #fda4af 50%, #fb7185 100%)",
                "elegant-gradient":
                    "linear-gradient(135deg, #667eea 0%, #764ba2 100%)",
                "sunset-gradient":
                    "linear-gradient(135deg, #f093fb 0%, #f5576c 100%)",
            },
            boxShadow: {
                glow: "0 0 20px rgba(244, 63, 94, 0.15)",
                "glow-lg": "0 0 40px rgba(244, 63, 94, 0.2)",
                card: "0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 10px 15px -3px rgba(0, 0, 0, 0.05)",
                "card-hover": "0 20px 40px -12px rgba(0, 0, 0, 0.15)",
                elegant: "0 10px 30px -5px rgba(0, 0, 0, 0.1)",
                soft: "0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)",
            },
            animation: {
                float: "float 6s ease-in-out infinite",
                "float-slow": "float 8s ease-in-out infinite",
                "fade-in": "fadeIn 0.6s ease-out",
                "fade-in-up": "fadeInUp 0.6s ease-out",
                "fade-in-down": "fadeInDown 0.5s ease-out",
                "slide-in-right": "slideInRight 0.5s ease-out",
                "pulse-soft": "pulseSoft 3s ease-in-out infinite",
                shimmer: "shimmer 2s linear infinite",
                "bounce-soft": "bounceSoft 2s ease-in-out infinite",
                "scale-in": "scaleIn 0.3s ease-out",
            },
            keyframes: {
                float: {
                    "0%, 100%": { transform: "translateY(0px)" },
                    "50%": { transform: "translateY(-20px)" },
                },
                fadeIn: {
                    "0%": { opacity: "0" },
                    "100%": { opacity: "1" },
                },
                fadeInUp: {
                    "0%": { opacity: "0", transform: "translateY(30px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" },
                },
                fadeInDown: {
                    "0%": { opacity: "0", transform: "translateY(-20px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" },
                },
                slideInRight: {
                    "0%": { opacity: "0", transform: "translateX(30px)" },
                    "100%": { opacity: "1", transform: "translateX(0)" },
                },
                pulseSoft: {
                    "0%, 100%": { opacity: "1" },
                    "50%": { opacity: "0.7" },
                },
                shimmer: {
                    "0%": { backgroundPosition: "-200% 0" },
                    "100%": { backgroundPosition: "200% 0" },
                },
                bounceSoft: {
                    "0%, 100%": { transform: "translateY(0)" },
                    "50%": { transform: "translateY(-5px)" },
                },
                scaleIn: {
                    "0%": { opacity: "0", transform: "scale(0.9)" },
                    "100%": { opacity: "1", transform: "scale(1)" },
                },
            },
        },
    },

    plugins: [forms],
};
