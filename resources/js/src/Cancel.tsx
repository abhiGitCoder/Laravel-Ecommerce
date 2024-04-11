import React from "react";
import { Link, useNavigate } from "react-router-dom";
import "../../css/cancel.css";

export default function Cancel() {
    const navigate = useNavigate();
    const pass = () => {
        const userInfo = localStorage.getItem("user-info");

        if (userInfo) {
            const data = JSON.parse(userInfo);
            const email = data.customer[0].email;
            navigate("/", { state: email });
        }
    };
    return (
        
        <div className="cancel-container">
            <h2 className="cancel-heading">
                <strong>Thank you for cancelling the order</strong>
            </h2>
            <div className="cancel-actions">
                <a className="cancel-link" onClick={pass}>
                    Home
                </a>
            </div>
        </div>
        
    );
}
