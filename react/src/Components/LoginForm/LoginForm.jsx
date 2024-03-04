import React from "react";
import logo from "../Assets/logo-google.png";
import "./LoginForm.css";

export const handleSignInClick = () => {
	window.location.href = "#";
};

export const LoginForm = () => {
	return (
		<div className="wrapper">
			<div className="image-container">
				<div className="login-container">
					<div className="logo"></div>
					<div className="login-text">
						<h2>Welcome to Lesson Management</h2>
						<br />
						<br />
						<p>Sing in to your account</p>
					</div>

					<div
						className="sign-in-container"
						onClick={handleSignInClick}
					>
						<img src={logo} alt="" />
						<h3>Sing in with Google</h3>
					</div>
				</div>
			</div>
		</div>
	);
};

export default LoginForm;
