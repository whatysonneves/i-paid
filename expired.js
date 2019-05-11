/*!
 * 
 * WnIPaid (https://github.com/whatysonneves/i-paid)
 * Developed by Whatyson Neves <contato@whatysonneves.com>
 * 
 */
WnIPaid = {
	run: function(time = "", btn = "", aviso = "") {
		this.body = document.querySelector("body");
		this.time = ( time == "" ? 8000 : time );
		this.btn_texto = ( btn == "" ? "× fechar" : btn );
		this.aviso_texto = ( aviso == "" ? "Avisa o dono do site pra ele pagar o carinha que fez o site (: " : aviso );
		this.btn = this.createButton();
		this.aviso = this.createAviso();
		this.seed();
	},
	createButton: function() {
		var btn = document.createElement("a");
		btn.style = "font-weight: bold; color: rgba(255, 255, 255, 0.9); text-decoration: none;";
		btn.href = "javascript:void(0);";
		btn.onclick = function() { WnIPaid.dismiss(); };
		btn.appendChild(document.createTextNode(this.btn_texto));
		return btn;
	},
	createAviso: function() {
		var aviso = document.createElement("div");
		aviso.id = "wn-aviso-i-paid";
		aviso.style = "text-align: center; width: 100%; position: fixed; top: 0; left: 0; background: rgba(255, 0, 0, 0.6); color: white; padding: 15px; font-size: 12pt; border-bottom: 2px solid rgba(255, 0, 0, 0.8)";
		aviso.appendChild(document.createTextNode(this.aviso_texto));
		aviso.appendChild(this.btn);
		return aviso;
	},
	seed: function() {
		this.body.append(this.aviso);
		return setTimeout(function() {
			WnIPaid.dismiss();
		}, this.time);
	},
	dismiss: function() {
		if(document.getElementById("wn-aviso-i-paid") !== null) {
			this.body.removeChild(this.aviso);
			console.info("É sério, avisa o cara lá por favor :)");
		}
	}
}
WnIPaid.run();
