package eshop2;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.Properties;

import com.google.common.collect.ImmutableList;

public class dbcon {
	
	 private static final String CONNECTION_NAME = "eshopserver:us-central1:tables";
	 private static final String DB_NAME = "logininfo";
	 private static final String DB_USER = "root";
	 private static final String DB_PASSWORD = "JulianNagelsmann";
	 private static ImmutableList<String> requiredEnvVars = ImmutableList
	     .of("MYSQL_USER", "MYSQL_PASS", "MYSQL_DB", "MYSQL_CONNECTION_NAME");
	 
	
	
	public static void main(String[] args) throws SQLException {
		Connection conn = null;
		
		String jdbcURL = String.format("jdbc:mysql:///%s", DB_NAME);
		Properties connProps = new Properties();
		connProps.setProperty("user", DB_USER);
		connProps.setProperty("password", DB_PASSWORD);
		connProps.setProperty("socketFactory", "com.google.cloud.sql.mysql.SocketFactory");
		connProps.setProperty("cloudSqlInstance", CONNECTION_NAME);
		
		try {
			Class.forName("com.mysql.jdbc.Driver");
		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		conn = DriverManager.getConnection(jdbcURL);
		System.out.println(conn);
		
		
		
		
		
		
		
		System.out.println("hellop");
	}

}
