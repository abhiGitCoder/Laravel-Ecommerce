import React from "react";
import "../../css/navbar.css";
import { FaBars, FaCartPlus } from "react-icons/fa";
import { Link, useNavigate } from "react-router-dom";

export default function Navbar({ visible, setVisible }) {
    const navigate = useNavigate();
    const userInfo = localStorage.getItem("user-info");
    const isLoggedIn = !!userInfo;


    const handleLogOut = () => {
        localStorage.removeItem("user-info");
      
        window.location.reload();
     
    };

    const pass = () => {
        if (isLoggedIn) {
            const data = JSON.parse(userInfo);
            const email = data.customer[0].email;
            navigate("/", { state: email });
        } else {
            navigate("/");
        }
    };
    return (
        <div>
            <nav className="nav">
               
                <ul className="b1">
                    <li>Ecommerce website</li>
                </ul>
                <ul className="b2">
                    <li>
                        <a onClick={pass}>Home</a>
                    </li>
                    {isLoggedIn ? (
                        <>
                            <li>
                                <Link to="/cart" style={{ margin: 5 }}>
                                    <FaCartPlus />
                                </Link>
                                <Link to="/cart">Cart</Link>
                            </li>
                            <li>
                                <Link to="/order">Orders</Link>
                            </li>
                            <li>
                                <Link onClick={handleLogOut}>Log Out</Link>
                            </li>
                        </>
                    ) : (
                        <>
                            <li>
                                <Link to="/login">Login</Link>
                            </li>
                            <li>
                                <Link to="/register">Register</Link>
                            </li>
                        </>
                    )}
                </ul>
            </nav>
        </div>
    );
}
