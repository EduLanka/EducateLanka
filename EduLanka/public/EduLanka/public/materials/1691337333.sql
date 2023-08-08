USE [master]
GO
/****** Object:  Database [Tutorial6]    Script Date: 5/24/2023 3:39:30 PM ******/
CREATE DATABASE [Tutorial6]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'Tutorial6', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.SQLEXPRESS\MSSQL\DATA\Tutorial6.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'Tutorial6_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.SQLEXPRESS\MSSQL\DATA\Tutorial6_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT, LEDGER = OFF
GO
ALTER DATABASE [Tutorial6] SET COMPATIBILITY_LEVEL = 160
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [Tutorial6].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [Tutorial6] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [Tutorial6] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [Tutorial6] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [Tutorial6] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [Tutorial6] SET ARITHABORT OFF 
GO
ALTER DATABASE [Tutorial6] SET AUTO_CLOSE ON 
GO
ALTER DATABASE [Tutorial6] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [Tutorial6] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [Tutorial6] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [Tutorial6] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [Tutorial6] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [Tutorial6] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [Tutorial6] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [Tutorial6] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [Tutorial6] SET  ENABLE_BROKER 
GO
ALTER DATABASE [Tutorial6] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [Tutorial6] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [Tutorial6] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [Tutorial6] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [Tutorial6] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [Tutorial6] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [Tutorial6] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [Tutorial6] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [Tutorial6] SET  MULTI_USER 
GO
ALTER DATABASE [Tutorial6] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [Tutorial6] SET DB_CHAINING OFF 
GO
ALTER DATABASE [Tutorial6] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [Tutorial6] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [Tutorial6] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [Tutorial6] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
ALTER DATABASE [Tutorial6] SET QUERY_STORE = ON
GO
ALTER DATABASE [Tutorial6] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 1000, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200, WAIT_STATS_CAPTURE_MODE = ON)
GO
USE [Tutorial6]
GO
/****** Object:  Table [dbo].[Branch]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Branch](
	[branch_id] [varchar](4) NOT NULL,
	[shop_id] [varchar](4) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[branch_id] ASC,
	[shop_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Branch Details]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Branch Details](
	[branch_id] [varchar](4) NULL,
	[shop_id] [varchar](4) NULL,
	[branch_telno] [int] NOT NULL,
	[branch_location] [varchar](20) NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Customer]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Customer](
	[customer_id] [varchar](4) NOT NULL,
	[product_id] [varchar](4) NULL,
	[customer_name] [varchar](50) NOT NULL,
	[house_num] [int] NULL,
	[street] [varchar](20) NULL,
	[city] [varchar](20) NULL,
PRIMARY KEY CLUSTERED 
(
	[customer_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Customer Contact]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Customer Contact](
	[customer_id] [varchar](4) NOT NULL,
	[mobile_number] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[customer_id] ASC,
	[mobile_number] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Customer Contact2]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Customer Contact2](
	[customer_id] [varchar](4) NOT NULL,
	[mobile_number] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[customer_id] ASC,
	[mobile_number] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Customer2]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Customer2](
	[customer_id] [varchar](4) NOT NULL,
	[customer_name] [varchar](50) NOT NULL,
	[house_num] [int] NOT NULL,
	[street] [varchar](20) NOT NULL,
	[city] [varchar](20) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[customer_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Employee]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Employee](
	[employee_id] [varchar](4) NOT NULL,
	[branch_id] [varchar](4) NULL,
	[shop_id] [varchar](4) NOT NULL,
	[employee_name] [varchar](50) NOT NULL,
	[house_num] [int] NULL,
	[street] [varchar](20) NULL,
	[city] [varchar](20) NULL,
PRIMARY KEY CLUSTERED 
(
	[employee_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Employee Contact]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Employee Contact](
	[employee_id] [varchar](4) NOT NULL,
	[mobile_number] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[employee_id] ASC,
	[mobile_number] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Employee Email]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Employee Email](
	[employee_id] [varchar](4) NOT NULL,
	[email_address] [varchar](255) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[employee_id] ASC,
	[email_address] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Instructor]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Instructor](
	[id] [int] NOT NULL,
	[iname] [varchar](20) NULL,
	[email] [varchar](20) NULL,
	[mobile] [varchar](20) NULL,
	[subject_id] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Inventory]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Inventory](
	[inventory_id] [varchar](4) NOT NULL,
	[employee_id] [varchar](4) NOT NULL,
	[quantity_in_stock] [int] NOT NULL,
	[last_update_date] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[inventory_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Product]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Product](
	[product_id] [varchar](4) NOT NULL,
	[inventory_id] [varchar](4) NULL,
	[product_name] [varchar](20) NOT NULL,
	[price] [decimal](10, 2) NOT NULL,
	[product_availability] [bit] NULL,
PRIMARY KEY CLUSTERED 
(
	[product_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Product_Category]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Product_Category](
	[product_id] [varchar](4) NOT NULL,
	[category_id] [varchar](5) NOT NULL,
	[category_name] [varchar](20) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[product_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Shop]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Shop](
	[shop_id] [varchar](4) NOT NULL,
	[shop_name] [varchar](50) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[shop_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Student]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Student](
	[sid] [int] NOT NULL,
	[sname] [varchar](20) NULL,
	[subject_id] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[sid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Subject]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Subject](
	[subject_id] [int] NOT NULL,
	[sname] [varchar](20) NULL,
PRIMARY KEY CLUSTERED 
(
	[subject_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Supplier]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Supplier](
	[supplier_id] [varchar](4) NOT NULL,
	[supplier_name] [varchar](20) NOT NULL,
	[supplier_mobile] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[supplier_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Supplier_products]    Script Date: 5/24/2023 3:39:30 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Supplier_products](
	[supplier_id] [varchar](4) NOT NULL,
	[products_supplied] [varchar](20) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[supplier_id] ASC,
	[products_supplied] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[Product] ADD  DEFAULT ((1)) FOR [product_availability]
GO
ALTER TABLE [dbo].[Branch]  WITH CHECK ADD FOREIGN KEY([shop_id])
REFERENCES [dbo].[Shop] ([shop_id])
GO
ALTER TABLE [dbo].[Branch Details]  WITH CHECK ADD FOREIGN KEY([branch_id], [shop_id])
REFERENCES [dbo].[Branch] ([branch_id], [shop_id])
GO
ALTER TABLE [dbo].[Customer]  WITH CHECK ADD FOREIGN KEY([product_id])
REFERENCES [dbo].[Product] ([product_id])
GO
ALTER TABLE [dbo].[Customer Contact]  WITH CHECK ADD FOREIGN KEY([customer_id])
REFERENCES [dbo].[Customer] ([customer_id])
GO
ALTER TABLE [dbo].[Customer Contact2]  WITH CHECK ADD FOREIGN KEY([customer_id])
REFERENCES [dbo].[Customer] ([customer_id])
GO
ALTER TABLE [dbo].[Employee]  WITH CHECK ADD FOREIGN KEY([branch_id], [shop_id])
REFERENCES [dbo].[Branch] ([branch_id], [shop_id])
GO
ALTER TABLE [dbo].[Employee Contact]  WITH CHECK ADD FOREIGN KEY([employee_id])
REFERENCES [dbo].[Employee] ([employee_id])
GO
ALTER TABLE [dbo].[Employee Email]  WITH CHECK ADD FOREIGN KEY([employee_id])
REFERENCES [dbo].[Employee] ([employee_id])
GO
ALTER TABLE [dbo].[Instructor]  WITH CHECK ADD  CONSTRAINT [sub] FOREIGN KEY([subject_id])
REFERENCES [dbo].[Subject] ([subject_id])
GO
ALTER TABLE [dbo].[Instructor] CHECK CONSTRAINT [sub]
GO
ALTER TABLE [dbo].[Inventory]  WITH CHECK ADD FOREIGN KEY([employee_id])
REFERENCES [dbo].[Employee] ([employee_id])
GO
ALTER TABLE [dbo].[Product]  WITH CHECK ADD FOREIGN KEY([inventory_id])
REFERENCES [dbo].[Inventory] ([inventory_id])
GO
ALTER TABLE [dbo].[Product_Category]  WITH CHECK ADD FOREIGN KEY([product_id])
REFERENCES [dbo].[Product] ([product_id])
GO
ALTER TABLE [dbo].[Student]  WITH CHECK ADD FOREIGN KEY([subject_id])
REFERENCES [dbo].[Subject] ([subject_id])
GO
ALTER TABLE [dbo].[Supplier_products]  WITH CHECK ADD FOREIGN KEY([supplier_id])
REFERENCES [dbo].[Supplier] ([supplier_id])
GO
USE [master]
GO
ALTER DATABASE [Tutorial6] SET  READ_WRITE 
GO
