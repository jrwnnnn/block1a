// @ts-check
import { defineConfig } from "astro/config";
import cloudflare from "@astrojs/cloudflare";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
	site: "https://jrwnnnn.me",
	output: "server",
	adapter: cloudflare({
		remoteBindings: !process.env.CI,
	}),
	vite: {
		plugins: [tailwindcss()],
	},
});
