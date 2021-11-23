export type GameRunner = "EMULATOR_GBA" | "EMULATOR_NES" | "IFRAME" | "UNITY" | "RUFFLE";
export interface Game {
	name: string;
	runner: GameRunner;
	thumbnail: string;
	game: string;
	aspectRatio?: number;
	width?: number;
}

export default <Game[]>[
  
  
  
  {
		name: "Chrome Dino",
		runner: "IFRAME",
		game: "/built-games/chromedino/index.html",
		thumbnail: "https://cdn.jsdelivr.net/gh/joshmerlino/shsg-pfile/thumbs/chrome-dino.jpg",
		width: 600,
		aspectRatio: 3
	}, {
		name: "Cookie Clicker",
		runner: "IFRAME",
		game: "/built-games/cookieclicker/index.html",
		thumbnail: "https://cdn.jsdelivr.net/gh/joshmerlino/shsg-pfile/thumbs/cookie-clicker.jpg",
		width: 1080,
		aspectRatio: 3 / 2
	}, {
		name: "CSGOClicker",
		runner: "IFRAME",
		game: "/built-games/csgoclicker/index.html",
		thumbnail: "https://cdn.jsdelivr.net/gh/joshmerlino/shsg-pfile/thumbs/csgoclicker.jpg",
		width: 1080,
		aspectRatio: 5 / 3
	}, {
		name: "Tanuki Sunset",
		runner: "IFRAME",
		game: "/built-games/takumiraccoon/index.html",
		thumbnail: "https://cdn.jsdelivr.net/gh/joshmerlino/shsg-pfile/thumbs/tanuki-sunset.jpg",
		width: 800,
		aspectRatio: 800 / 660
	},
  
  
  
  
  
  
  // UNITY GAMES
	{
		name: "Slope",
		runner: "UNITY",
		game: "https://cdn.jsdelivr.net/gh/JoshMerlino/shsg-pfile/games/slope_v7.json",
		thumbnail: "https://cdn.jsdelivr.net/gh/joshmerlino/shsg-pfile/thumbs/slope.jpg",
		aspectRatio: 16 / 9,
		width: 1200
	},
