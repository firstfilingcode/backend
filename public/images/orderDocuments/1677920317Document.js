import React, { useEffect, useRef, useState } from "react";
import { myAxios } from "../common/services/Helper";
// import { ChatTextSend } from "../services/ChatText";
import { Form, FormGroup, Input, Row, Col, Button } from "reactstrap";
import { useLocation } from "react-router-dom";
import moment from "moment";
import Modal from "react-bootstrap/Modal";
import { saveAs } from "file-saver";
import { ChatTextSend } from "../common/services/ChatText";
import document_pdf from "../common/Images/document_pdf.png";
import order_timing from "../common/Images/order_timing.png";
import checkgreen from "../common/Images/checkgreen.png";
import chat_loingbtn from "../common/Images/chat_loingbtn.png";
import { BASE_URL } from "../common/services/Helper";
import checkcircle from '../common/Images/checkCircle.svg';
import { ReactSession } from 'react-client-session';
import { Tooltip as ReactTooltip } from 'react-tooltip';

const Document = (props) => {
    const [passwordProtected, setPasswordProtected] = useState(false);
    const bottomRef = useRef(null);
    const [myArray, setMyArray] = useState([]);
    const [show, setShow] = useState(false);
    const [showModal, setShowModal] = useState(false);
    const [file1, setFile1] = useState([]);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const [documentCount, setDocumentCount] = useState(false);
    const [expertAssiged, setExpertAssiged] = useState(false);
    const [data, setData] = useState([]);
    const [data2, setData2] = useState([]);
    const [dataTable, setDataTable] = useState([]);
    const [value1, setValue1] = useState("");
    const [order_no, setOrder_no] = useState("");
    const [workStatus, setWorkStatus] = useState("");

    const [trackOrder, setTrackOrder] = useState("");

    const handleTrackOrder = () => {
        fetch(
            BASE_URL + "/trackOrder/" + props.state.order_id + "/" + ReactSession.get("user_id")
        )
            .then((res) => res.json())
            .then((json) => {

                setTrackOrder(json)
                // alert(JSON.stringify(json))
                // setData(json.data);
                // setDocumentCount(json.documentsCount)
                // setExpertAssiged(json.expert_assigned)
            });
    }




    useEffect(() => {

        window.scroll({ top: 0, left: 0, behavior: 'smooth', block: 'end', inline: "end" });


        const getDocList = () => {

            //  OrderIdData("order_id",window.location.state.order_id);
            fetch(
                BASE_URL + "/uploadOrderDocument/" +
                props.state.order_id + "/" + ReactSession.get('user_id'))
                .then((res) => res.json())
                .then((json) => {
                    setOrder_no(json.data[0].order_no)
                    setWorkStatus(json.data[0].work_status)
                    localStorage.setItem("ca_assigned", json.expert_assigned_ca.mobile)
                    localStorage.setItem("ca_assigned_name", json.expert_assigned_ca.name)
                    localStorage.setItem("rm_assigned", json.expert_assigned_rm.mobile)
                    localStorage.setItem("rm_assigned_name", json.expert_assigned_rm.name)
                    localStorage.setItem("service_cover", json.serviceDetail[0].data)
                    setData(json.data);
                    setData2(json.data2);
                    // setDocumentCount(json.documentsCount)
                    // setExpertAssiged(json.expert_assigned)

                    setDataTable(json.data);
                    window.dispatchEvent(new Event("expert_assigned"));
                });
        };
        getDocList();
        handleTrackOrder();

    }, []);

    let encryptedFile = [];

    // start add new document row
    const [inputList, setInputList] = useState([]);

    let formData = new FormData();
    let formData3 = new FormData();
    var fileName = "";
    const onChangeSubmit = (e) => {
        let file = e.target.files[0];
        let id = e.target.id;


        //alert(id)
        let value = e.target.getAttribute("data-id");

        let pass_id = "password_" + value;
        let submit_id = "order_document_submit_" + value;
        let upload_id = "order_document_input_" + value;
        let loading_bar = "loading_bars_" + value;
        let passvalue = document.getElementById(pass_id).value;
        // alert(passvalue);
        formData.append("id", value);
        formData.append("files", file);
        formData.append("password", passvalue);
        const reader = new FileReader();
        reader.readAsArrayBuffer(file);
        reader.onload = function () {

            var files = new Blob([reader.result], { type: 'application/pdf' });
            files.text().then(x => {
                // console.log("isEncrypted", x.includes("Encrypt")) // true, if Encrypted
                if (x.includes("Encrypt") === true) {
                    encryptedFile["file"] = file;
                    encryptedFile["pass_id"] = pass_id;
                    encryptedFile["value"] = value;
                    encryptedFile["loading_bar"] = loading_bar;

                    document.getElementById(pass_id).style.display = "block";
                    document.getElementById(submit_id).style.display = "block";
                    document.getElementById(upload_id).style.display = "none";

                    document.getElementsByClassName(pass_id)[0].style.display = "block";

                    // if (passvalue !== "") {
                    //     document.getElementById(pass_id).style.display = "none";
                    //     document.getElementById(pass_id).value = "";
                    //     document.getElementsByClassName(pass_id)[0].style.display = "none";
                    //     document.getElementsByClassName(loading_bar)[0].style.display = "block";
                    //     document.getElementById(value).style.display = "none";
                    //     myAxios({
                    //         method: "post",
                    //         url: BASE_URL + "/orderDocument",
                    //         data: formData,
                    //         headers: { "Content-Type": "multipart/form-data" },
                    //     })
                    //         .then(function (response) {
                    //             document.getElementsByClassName(loading_bar)[0].style.display = "none";
                    //             document.getElementById(value).style.display = "block";
                    //             //handle success
                    //             // alert(response.data.message);
                    //             // setShowModal(true);
                    //             // setTimeout(() => {
                    //             //     setShowModal(false);
                    //             // }, 3000);
                    //             const getDocList = () => {
                    //                 fetch(
                    //                     BASE_URL + "/uploadOrderDocument/"
                    //                     + props.state.order_id + "/" + ReactSession.get('user_id'))
                    //                     .then((res) => res.json())
                    //                     .then((json) => {
                    //                         setData(json.data)
                    //                         setData2(json.data2)
                    //                         // document.getElementById(value).disabled = true;
                    //                         // setDocumentCount(json.documentsCount)
                    //                         //setExpertAssiged(json.expert_assigned)
                    //                         // alert(JSON.stringify(json.data));
                    //                         setDataTable(json.data);
                    //                         //   const deletVal=[...inputList]
                    //                         // deletVal.splice(1)
                    //                         // setInputList(deletVal)
                    //                     });
                    //             };
                    //             getDocList();
                    //         })
                    //         .catch(function (response) {
                    //             //handle error
                    //             // console.log(response);
                    //         });

                    // }
                }
                else {
                    document.getElementsByClassName(loading_bar)[0].style.display = "block";
                    document.getElementById(value).style.display = "none";
                    myAxios({
                        method: "post",
                        url: BASE_URL + "/orderDocument",
                        data: formData,
                        headers: { "Content-Type": "multipart/form-data" },
                    })
                        .then(function (response) {
                            document.getElementsByClassName(loading_bar)[0].style.display = "none";
                            document.getElementById(value).style.display = "block";
                            //handle success
                            // alert(response.data.message);
                            // setShowModal(true);
                            // setTimeout(() => {
                            //     setShowModal(false);
                            // }, 3000);
                            const getDocList = () => {
                                fetch(
                                    BASE_URL + "/uploadOrderDocument/"
                                    + props.state.order_id + "/" + ReactSession.get('user_id'))
                                    .then((res) => res.json())
                                    .then((json) => {
                                        setData(json.data)
                                        setData2(json.data2)
                                        // document.getElementById(value).disabled = true;
                                        // setDocumentCount(json.documentsCount)
                                        //setExpertAssiged(json.expert_assigned)
                                        // alert(JSON.stringify(json.data));
                                        setDataTable(json.data);
                                        //   const deletVal=[...inputList]
                                        // deletVal.splice(1)
                                        // setInputList(deletVal)
                                    });
                            };
                            getDocList();
                            handleTrackOrder()
                        })
                        .catch(function (response) {
                            //handle error
                            // console.log(response);
                        });

                }
                // console.log("isEncrypted", x.substring(x.lastIndexOf("<<"), x.lastIndexOf(">>")).includes("/Encrypt"));
                // console.log(file.name);
            });

        }


    };

    let misFileArray = [];

    const misHandle = (e) => {
        misFileArray[0] = e.target.files[0];

    }
    const [count, setCount] = useState(0);
    const incrementCount = () => {
        // Update state with incremented value
        setCount(count + 1);
    };
    // const onAddFileChange = (e) => {
    //     let file = e.target.files[0];
    //     if (file.size > 15e6) { alert("file size is greater than 15mb plz select smaller than 15mb") }
    //     else {
    //         fileName = file.name;
    //         // setInputList(inputList.concat(<Input key={inputList.length} />));
    //         incrementCount();
    //         let id = e.target.id;
    //         myArray.push(file);
    //     }
    // };

    //end add new documents row
    const downloadFile = (e) => {
        let formDataId = new FormData();
        formDataId.append("id", e);
        myAxios({
            method: "post",
            url: BASE_URL + "/downloadOrderDocuments",
            data: formDataId,
            headers: { "Content-Type": "multipart/form-data" },
        })
            .then(function (response) {
                saveAs(response.data.file_url);
            })
            .catch(function (response) {
                //handle error
                // console.log(response);
            });
    };

    const [chatWindow, setChatWindow] = useState(false);

    const location = useLocation();
    let order_id1 = props.state.order_id;
    const [MessageChat, setMessageChat] = useState({
        message: "",
        order_id: order_id1,
        user_id: ReactSession.get('user_id'),
    });

    const [ErrorMessage, setErrorMessage] = useState("");
    const [errorColor, setErrorColor] = useState("white");
    const handleChange = (event, property) => {
        //dynamic setting the values
        setMessageChat({ ...MessageChat, [property]: event.target.value });
        setErrorMessage("");
        setErrorColor("white");
    };
    // console.log(MessageChat);

    const submitForm = (event) => {
        event.preventDefault();
        if (MessageChat.message === "") {
            setErrorMessage("Message Field Can't Be Null");
            setErrorColor("red");
        } else {
            ChatTextSend(MessageChat).then((resp) => {
                // console.log(resp);
                if (resp.success) {
                    setMessageChat({
                        message: "",
                        order_id: order_id1,
                        user_id: ReactSession.get('user_id'),
                    });
                    refreshChat();
                } else {
                    refreshChat();
                }
                // console.log("success log");
            });
        }
    };

    const [Chat, setChat] = useState([]);
    const [chatCount, setChatCount] = useState("");

    useEffect(() => {
        refreshChat();
    }, []);

    // useEffect(() => {

    //     refreshChat();
    //     setInterval(function () {
    //         refreshChat();
    //     }, 100000);

    // }, []);

    let formData4 = new FormData();

    const encryptedFileSubmit = () => {

        let submit_id = "order_document_submit_" + encryptedFile["value"];
        let upload_id = "order_document_input_" + encryptedFile["value"];

        formData4.append("id", encryptedFile["value"]);
        formData4.append("files", encryptedFile["file"]);
        formData4.append("password", document.getElementById(encryptedFile["pass_id"]).value);
        document.getElementById(encryptedFile["pass_id"]).style.display = "none";
        document.getElementById(encryptedFile["pass_id"]).value = "";
        document.getElementsByClassName(encryptedFile["pass_id"])[0].style.display = "none";
        document.getElementsByClassName(encryptedFile["loading_bar"])[0].style.display = "block";
        document.getElementById(encryptedFile["value"]).style.display = "none";
        myAxios({
            method: "post",
            url: BASE_URL + "/orderDocument",
            data: formData4,
            headers: { "Content-Type": "multipart/form-data" },
        })
            .then(function (response) {
                document.getElementsByClassName(encryptedFile["loading_bar"])[0].style.display = "none";
                document.getElementById(encryptedFile["value"]).style.display = "block";
                document.getElementById(submit_id).style.display = "none";
                document.getElementById(upload_id).style.display = "block";
                //handle success
                // alert(response.data.message);
                // setShowModal(true);
                // setTimeout(() => {
                //     setShowModal(false);
                // }, 3000);
                const getDocList = () => {
                    fetch(
                        BASE_URL + "/uploadOrderDocument/"
                        + props.state.order_id + "/" + ReactSession.get('user_id'))
                        .then((res) => res.json())
                        .then((json) => {
                            setData(json.data)
                            setData2(json.data2)
                            // document.getElementById(value).disabled = true;
                            // setDocumentCount(json.documentsCount)
                            //setExpertAssiged(json.expert_assigned)
                            // alert(JSON.stringify(json.data));
                            setDataTable(json.data);
                            //   const deletVal=[...inputList]
                            // deletVal.splice(1)
                            // setInputList(deletVal)
                        });
                };
                getDocList();
                handleTrackOrder();
            })
            .catch(function (response) {
                //handle error
                // console.log(response);
            });


    }

    const refreshChat = () => {
        fetch(
            BASE_URL + "/getChat/" + props.state.order_id
        )
            .then((res) => res.json())
            .then((json) => {
                setChat(json.data);
                setChatCount(json.chatCount);
                // alert(json.data);
                handleBottom();
            });
    };

    const handleMessageBox = () => {
        setChatWindow((value) => !value);
    };
    const handleBottom = () => {
        // bottomRef.current?.scrollIntoView({ behavior: "smooth" });
    };

    useEffect(() => {

        length()

    }, [data2, dataTable]);

    const length = () => {
        var slides = document.getElementsByClassName("srno");
        for (var i = 0; i < slides.length; i++) {
            slides[i].innerHTML = i + 1
        }
    };

    function otherDocumentSubmit() {
        document.getElementById("mis_loader_for").style.display = "none";
        document.getElementById("mis_loader").style.display = "block";

        let doc_name = document.getElementById("mis_file_name").value;
        formData3.append("order_id", props.state.order_id);
        formData3.append("user_id", ReactSession.get('user_id'));
        formData3.append("files", misFileArray[0]);
        formData3.append("documents", doc_name);
        formData3.append("password", "dfd");

        myAxios({
            method: "post",
            url: BASE_URL + "/miscellaneousDocument",
            data: formData3,
            headers: { "Content-Type": "multipart/form-data" },
        })
            .then(function (response) {



                const getDocList = () => {
                    fetch(
                        BASE_URL + "/uploadOrderDocument/"
                        + props.state.order_id + "/" + ReactSession.get('user_id'))
                        .then((res) => res.json())
                        .then((json) => {
                            setData(json.data)
                            setData2(json.data2)
                            // document.getElementById(value).disabled = true;
                            // setDocumentCount(json.documentsCount)
                            //setExpertAssiged(json.expert_assigned)
                            // alert(JSON.stringify(json.data));
                            setDataTable(json.data);

                            //   const deletVal=[...inputList]
                            // deletVal.splice(1)
                            // setInputList(deletVal)
                            document.getElementById("mis_loader_for").style.display = "block";
                            document.getElementById("mis_loader").style.display = "none";
                            document.getElementById("mis_file_name").value = "";
                            document.getElementById("mis_password").value = "";
                            document.getElementById("mis_file").value = "";
                        });
                };
                if (response.status) {
                    getDocList();
                    handleTrackOrder();
                }
            })
            .catch(function (response) {
            });

    }

    return (
        <>
            <div className="row">
                <section className="DocBack">
                    <div className="col-md-12 order_text">
                        <h5>
                            {props.state.plan}
                        </h5>
                    </div>
                    <div className="col-md-12 docRequired">
                        <h4>Documents Required:</h4>
                    </div>
                    <div className="row">
                        <div className="col-md-8">
                            <div className="row">
                                {data.map((item) => {
                                    return (
                                        <>

                                            <div className="col-md-6">
                                                <div className="documentlist document_after">
                                                    <ul>


                                                        {item.status == 1 ? (
                                                            <>
                                                                {item.name !== "Miscellaneous" ?
                                                                    <li
                                                                        data-tip
                                                                        data-for={`Tip` + item.id}
                                                                    >
                                                                        <abbr title={item.name}>
                                                                            <div className="row">

                                                                                <div className="col-md-12"><img src={checkgreen} alt="checkgreen" /> {item.name.substring(0, 18)}{item.name.length > 18 ? "....." : ""} <span>*</span></div>

                                                                            </div>

                                                                        </abbr>
                                                                    </li>
                                                                    :
                                                                    ""
                                                                }
                                                            </>

                                                        ) : (



                                                            <li
                                                                data-tip
                                                                data-for={`Tip` + item.id}
                                                            >
                                                                <abbr title={item.name}>

                                                                    <div className="row">

                                                                        <div className="col-md-12"><img src={order_timing} alt="order_timing" /> {item.name.substring(0, 18)}{item.name.length > 18 ? "....." : ""}<span>*</span></div>

                                                                    </div>
                                                                </abbr>

                                                            </li>
                                                        )}


                                                    </ul>

                                                    <ReactTooltip id={`Tip` + item.id} place="top" effect="solid">
                                                        {item.name}
                                                    </ReactTooltip>

                                                </div>
                                            </div>

                                        </>
                                    )
                                })}
                            </div>
                        </div>
                        <div className="col-md-4">
                            <span className="textA1">Order Id :</span> <span className="textA1 "><b>{order_no}</b></span>
                            <br />
                            <span className="textA1">Order Status :</span> <span className="textA2 text-success">
                                 {/* {trackOrder !== "" ? trackOrder.work_done === false
                                ? trackOrder.caAssign === false
                                    ? trackOrder.documentsCount === false
                                        ? "Payment Done"
                                        : "Documents Uploaded"
                                    : "Expert Assigned"
                                : "Work Done" : ""} */}
                                {workStatus}
                                </span>
                        </div>
                    </div>
                </section >
            </div >
            <div className="row mb-3">
                <section className="order_chat">
                    <section className="chat-body">
                        <div className="row paddingtopchat">
                            {Chat === null ? ("Chat Start Here") : (
                                <>
                                    {
                                        Chat.map((item) => {
                                            return (
                                                <>
                                                    {item.role_id == 5 ? (
                                                        <>
                                                            <section className="flexsection">
                                                                <div className="fix">
                                                                    <div className="chat_costumer_3_border">
                                                                        <span>
                                                                            {item.role_id == 5 ? "You" : ""}{item.role_id == 2 ? "RM" : ""}{item.role_id == 1 ? "AD" : ""}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div className="mx-3">
                                                                    <section className="chat_costumer">
                                                                        <span dangerouslySetInnerHTML={{ __html: item.message }}></span>

                                                                    </section>
                                                                    <section className="chat_time">
                                                                        <span>{moment(item.created_at).format(
                                                                            "DD/MMM/YY , h:mm A"
                                                                        )}</span>
                                                                    </section>
                                                                </div>
                                                            </section>
                                                        </>
                                                    ) : (
                                                        <>
                                                            <section className="flexsection">
                                                                <div className="mx-3">
                                                                    <section className="chat_costumer">
                                                                        <span dangerouslySetInnerHTML={{ __html: item.message }}></span>

                                                                    </section>
                                                                    <section className="chat_time">
                                                                        <span>{moment(item.created_at).format(
                                                                            "DD/MMM/YY , h:mm A"
                                                                        )}</span>
                                                                    </section>
                                                                </div>
                                                                <div className="fix">
                                                                    <div className="chat_costumer_3_border">
                                                                        <span>
                                                                            {item.role_id == 5 ? "You" : ""}{item.role_id == 2 ? "RM" : ""}{item.role_id == 1 ? "AD" : ""}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </section>

                                                        </>
                                                    )}
                                                </>
                                            );
                                        })
                                    }
                                </>
                            )}

                        </div>
                    </section>
                    <section className="chat_footer">
                        <form onSubmit={submitForm}>
                            <div className="row">

                                {/* <div className="col-md-1 chatbox_emoji">
                                                <span><i className="fa fa-smile-o"></i></span>
                                            </div>
                                            <div className="col-md-1 chatbox_emoji">
                                                <span><i className="fa fa-paperclip"></i></span>
                                            </div> */}

                                <div className="col-md-10 col-8 chatbox_chatinput">
                                    <input type="text" onChange={(e) => handleChange(e, "message")}
                                        value={MessageChat.message} className="form-control" placeholder="Type your message...." />
                                </div>
                                <div className="col-md-1 col-2 chatbox_sand">
                                    <button type="submit" className="btn"><i className="fa fa-paper-plane-o"></i></button>
                                </div>
                                <div className="col-md-1 col-2 chatbox_sand">
                                    <button type="button" className="btn" onClick={refreshChat}><i className="fa fa-refresh"></i></button>
                                </div>
                                <span style={{ color: errorColor }}>{ErrorMessage}</span>
                            </div>
                        </form>

                    </section>

                </section>

                <div className="col-md-12 order_dropdown">
                    <p>Upload your Documents</p>
                </div>
                <section className="scrollUpload">

                    {
                        dataTable.map((item, index) => {
                            return (
                                <>
                                    {item.status == 1 ? (
                                        <div className="col-md-12">

                                            <div className="row upload_document">
                                                <div className="col-md-5 upload_document_2 col-10">
                                                    <small className="circleDoc srno"></small> <span>{item.documents.substring(0, 18)}{item.documents.length > 18 ? "....." : ""}</span>
                                                </div>
                                                <div className="col-md-1 upload_document_2 col-1">
                                                    <img src={checkgreen} alt="checkgreen" />
                                                </div>
                                                <div className="col-md-3 upload_document_2 col-10">
                                                    <img src={document_pdf} alt="" width="10px" />
                                                    <span>{item.files.substring(0, 18)}{item.files.length > 18 ? "....." : ""}</span>
                                                </div>
                                            </div>

                                        </div>
                                    ) : (
                                        ""
                                    )}
                                </>
                            );
                        })
                    }

                    {data2.map((item, index) => {
                        return (
                            <>
                                <div className={"col-md-12" + " loading_bars_" + item.id} style={{ display: 'none' }}>
                                    <div className="container1">
                                        <div className="loading1">
                                            <span className="text1">Loading</span>
                                            <div className="percent1">
                                                <div className="progress1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div className="col-md-12" id={item.id}>
                                    <div className="row upload_document">

                                        <div className="col-md-5 col-9 upload_document_2">
                                            <small className="circleDoc srno"></small> <span>{item.name.substring(0, 18)}{item.name.length > 18 ? "....." : ""}</span>
                                        </div>
                                        <div className="col-md-1 col-1 upload_document_2">
                                            <img src={checkcircle} alt="order_timing" />
                                        </div>
                                        <div className="col-md-3 col-1 order-input">
                                            <input
                                                type="password"
                                                style={{ display: 'none' }}
                                                className="form-control"
                                                id={"password_" + item.id}
                                                placeholder="password"
                                            />
                                            <span className={"password_" + item.id} style={{ position: 'absolute', color: 'red', display: 'none', fontSize: '10px' }}>Please Enter File Password Than Resubmit It   </span>
                                        </div>
                                        <div className="col-md-3 col-1">
                                            <section className="order_document_input" id={"order_document_input_" + item.id}>

                                                <input
                                                    type="file"
                                                    className="form-control pass_word"
                                                    id={count}
                                                    multiple=""
                                                    draggable="true"
                                                    onChange={(e) => {
                                                        // onAddFileChange(e);
                                                        onChangeSubmit(e);
                                                    }}
                                                    data-id={item.id}
                                                />
                                                <button className="btn" >Upload</button>
                                            </section>
                                            <section className="order_document_input" style={{ display: "none" }} id={"order_document_submit_" + item.id}>


                                                <button className="btn" onClick={encryptedFileSubmit}>Submit</button>
                                            </section>
                                        </div>

                                    </div>
                                </div>

                            </>
                        );
                    })}

                    {/* <div className="col-md-12 order_dropdown">
                    <p>Miscellaneous  </p>
                </div> */}
                    <div className="col-md-12 " id="mis_loader" style={{ display: 'none' }}>
                        <div className="container1">
                            <div className="loading1">
                                <span className="text1">Creating</span>
                                <div className="percent1">
                                    <div className="progress1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-12" id="mis_loader_for">
                        <div className="row upload_document">
                            <div className="col-md-3 col-8 order-input d-flex ">
                                <small className="circleDoc srno mt-2"></small>
                                <input
                                    type="text"
                                    className="form-control miscellaneousbg mx-2"
                                    id="mis_file_name"
                                    placeholder="File Name"
                                    value="Miscellaneous"
                                    readOnly
                                />
                            </div>
                            <div className="col-md-3 col-8 order-input">
                                <input
                                    type="password"
                                    className="form-control"
                                    id="mis_password"
                                    placeholder="Your Password"
                                />
                            </div>
                            <div className="col-md-3 col-8 order-input">
                                <input
                                    type="file"
                                    className="form-control"
                                    id="mis_file"
                                    onChange={(e) => {
                                        misHandle(e);
                                    }}

                                />
                            </div>
                            <div className="col-md-3 col-8 order-input order_document_input">
                                <button className="btn" onClick={otherDocumentSubmit}>Submit</button>
                            </div>
                        </div>
                    </div>
                </section>

                {inputList}
            </div >
            <Modal
                show={show}
                onHide={handleClose}
                keyboard={false}
                className="modal-xl"
            >
                <Modal.Header closeButton>
                    <Modal.Title>Guide to Upload Documents </Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <section
                        className="p-3 text-justify"
                        style={{ textAlign: "justify" }}
                    >
                        <b>Step 1 :</b> View the list of mandatory documents that you need
                        to upload and keep them ready.
                        <br />
                        <br />
                        <b>Step 2 :</b> Click on the “Drop any documents here, or Browse”
                        option to upload the documents. The file explorer from your
                        operating system will open. You can upload multiple documents by
                        selecting all the documents you want to upload. After selecting all
                        the documents, click on the “Open” button.
                        <br />
                        <br />
                        <b>Step 3 :</b> After the upload is complete, you can view the
                        uploaded documents on the screen below the “Required Documents” tab.
                        <br />
                        <br />
                        <b>Step 4 :</b> Click on the “Select Document Type” option against
                        each uploaded document and select the document type from the
                        dropdown list.
                        <br />
                        <br />
                        <b>Note :</b> Please note that you must select the document type for
                        each uploaded document before proceeding to the next step.
                        <br />
                        <br />
                        <b>Step 5 :</b> After selecting the document type for all your
                        uploaded documents, click on the “Submit & Proceed to Booking”
                        option.
                        <br />
                        <br />
                        <b>Note :</b> The process of uploading documents will be complete,
                        and our experts will take care of your ITR filing.
                        <br />
                    </section>
                </Modal.Body>
            </Modal>

            <Modal
                show={showModal}
                id="success_tic"
                onHide={() => setShowModal(false)}
                dialogClassName="modal-90w"
                backdrop="static"
                aria-labelledby="example-custom-modal-styling-title"
            >
                <Modal.Body className="p-0">
                    <div className="modal-content">
                        <div className="container-fluid">
                            <div className="row">
                                <div className="col-md-12 m-h-20 bg-img rounded-left" style={{ backgroundImage: 'url("https://images.unsplash.com/photo-1525097596740-cb2a70e07e3b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1267&q=80")' }} />
                                <div className="col-md-12 text-center py-5 px-sm-5">
                                    <h2 className="h2Text">File Add Successfully</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </Modal.Body>
            </Modal>

        </>
    )
}

export default Document 