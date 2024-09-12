<?xml version="1.0" encoding="utf-8"?>
<definitions xmlns="http://schemas.xmlsoap.org/wsdl/"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    name="IWinOrderEShopservice"
    targetNamespace="http://www.winorder.de"
    xmlns:tns="http://www.winorder.de"
    xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
    xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/"
    xmlns:mime="http://schemas.xmlsoap.org/wsdl/mime/">

    <message name="GetNewOrders0Request">
        <part name="Username" type="xs:string"/>
        <part name="Password" type="xs:string"/>
    </message>

    <message name="GetNewOrders0Response">
        <part name="return" type="xs:string"/>
        <part name="ErrorMessage" type="xs:string" minOccurs="0"/>
    </message>

    <message name="SendTrackingStatus1Request">
        <part name="Username" type="xs:string"/>
        <part name="Password" type="xs:string"/>
        <part name="OrdersID" type="xs:string"/>
        <part name="TrackingStatus" type="xs:string"/>
    </message>

    <message name="SendTrackingStatus1Response">
        <part name="return" type="xs:boolean"/>
        <part name="ErrorMessage" type="xs:string" minOccurs="0"/>
    </message>

    <portType name="IWinOrderEShop">
        <operation name="GetNewOrders">
            <input message="tns:GetNewOrders0Request"/>
            <output message="tns:GetNewOrders0Response"/>
        </operation>
        <operation name="SendTrackingStatus">
            <input message="tns:SendTrackingStatus1Request"/>
            <output message="tns:SendTrackingStatus1Response"/>
        </operation>
    </portType>

    <binding name="IWinOrderEShopbinding" type="tns:IWinOrderEShop">
        <soap:binding style="document" transport="http://schemas.xmlsoap.org/soap/http"/>
        <operation name="GetNewOrders">
            <soap:operation soapAction="urn:WinOrderEShopIntf-IWinOrderEShop#GetNewOrders"/>
            <input>
                <soap:body use="literal" namespace="urn:WinOrderEShopIntf-IWinOrderEShop"/>
            </input>
            <output>
                <soap:body use="literal" namespace="urn:WinOrderEShopIntf-IWinOrderEShop"/>
            </output>
        </operation>
        <operation name="SendTrackingStatus">
            <soap:operation soapAction="urn:WinOrderEShopIntf-IWinOrderEShop#SendTrackingStatus"/>
            <input>
                <soap:body use="literal" namespace="urn:WinOrderEShopIntf-IWinOrderEShop"/>
            </input>
            <output>
                <soap:body use="literal" namespace="urn:WinOrderEShopIntf-IWinOrderEShop"/>
            </output>
        </operation>
    </binding>

    <service name="IWinOrderEShopservice">
        <port name="IWinOrderEShopPort" binding="tns:IWinOrderEShopbinding">
            <soap:address location="https://portal-v01.test/soap-server"/>
        </port>
    </service>
</definitions>
