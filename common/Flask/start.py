from flask import Flask, render_template, request, redirect
from pandas import DataFrame
import csv
import pandas as pd
import numpy as np
import seaborn as sns
import matplotlib.pyplot as plt
import mysql.connector
import os

app = Flask(__name__)
# @app.route('/')
# def index():
#     return render_template('excel_file_validation.html')

@app.route('/')
def index():
    return render_template('Excel_File_Format_Checking')

# @app.route('/home')
# def home():
#     return render_template('home.php')

@app.route('/Excel_File_Format_Checking')
def Excel_File_Format_Checking():
    # In[1]:
    # import pandas as pd
    # from pandas import DataFrame
    # import mysql.connector

    # In[2]:
    #load an excel file
    xl1=pd.ExcelFile("C:/xampp/htdocs/FOE/common/Flask/Excel File/students_data.xlsx")
    xl2=pd.ExcelFile("C:/xampp/htdocs/FOE/common/Flask/Excel File/File Formats/Students_Validation_Format.xlsx")

    # In[3]:
    #Know no of Sheets
    sheet_names1=xl1.sheet_names
    sheet_names2=xl2.sheet_names

    # In[4]:
    #Find No. of Sheets
    length=len(xl1.sheet_names)

    # In[5]:
    sheet_passed=0
    for i in range(1,length+1):
        count=0
        df1=xl1.parse(sheet_names1[i-1])
        df2=xl2.parse(sheet_names2[i-1])
        for j in range(len(df2.columns)):
            if(df1.columns[j].lower()==df2.columns[j].lower()):
                count+=1
        if(count==len(df2.columns)):
            sheet_passed+=1

    if(sheet_passed==3):
        return render_template('data_insertion.html')
    else:
        redirect("http://localhost/FOE/common/Flask/templates/error.php?msg=Excel File Format Failed to Match")



# @app.route('/exit')
# def exit():
#     return render_template("exit.html")

@app.route('/DataInsertion')
def DataInsertion():
    # In[1]:
    try:
        # In[2]:
        #load an excel file
        xl=pd.ExcelFile("C:/xampp/htdocs/FOE/common/Flask/Excel File/students_data.xlsx")

        # In[3]:
        #Know no of Sheets
        sheet_names=xl.sheet_names

        # In[4]:
        #Find No. of Sheets
        length=len(xl.sheet_names)

        # In[5]:
        for i in range(1,length+1):
            conn=mysql.connector.connect(host='localhost',user='root',password='',database=sheet_names[i-1])
            cursor=conn.cursor()
            query='insert into `students_validation_details` values '
            df=xl.parse(sheet_names[i-1])
            df.dropna(inplace=True)
            df=df.values
            for j in df:
                query+=str(tuple(j))+','
            query=query[:-1]
            cursor.execute(query)
            conn.commit()
            conn.close()

        return redirect("http://localhost/FOE/common/Flask/templates/exit.php?msg=Records inserted into Database Successfully")
    
    except:
        return redirect('http://localhost/FOE/common/Flask/templates/error.php?msg=Anomalies in Data...!!')

@app.route('/Analysis_III-I')
def Analysis_III_I():
    year_sem(1)
    return redirect("http://localhost/FOE/common/Flask/templates/Analysis_Show.php?value=III-I")


@app.route('/Analysis_III-II')
def Analysis_III_II():
    year_sem(2)
    return redirect("http://localhost/FOE/common/Flask/templates/Analysis_Show.php?value=III-II")

@app.route('/Analysis_IV-I')
def Analysis_IV_I():
    year_sem(3)
    return redirect("http://localhost/FOE/common/Flask/templates/Analysis_Show.php?value=IV-I")

def year_sem(count):
    status=""
    if(count==1):
        status=analysis('III-I')
    elif(count==2):
        status=analysis('III-II')
    elif(count==3):
        status=analysis('IV-I')

    if(status=="Success"):
        return(True)
    else:
        redirect("http://localhost/FOE/common/Flask/templates/error.php?msg=Error in loading Analysis Please Contact Admin")

def analysis(year_sem):
    #!/usr/bin/env python
    # coding: utf-8
    
    # In[2]:
    try:
        db_name=year_sem
        #establishing db connection
        conn=mysql.connector.connect(host="localhost",user="root",password="",database=db_name)

        q="select nickname from track_no_of_seats"
        cursor=conn.cursor()
        cursor.execute(q)
        subs=cursor.fetchall()

        subjects={}
        for i in range(len(subs)):
            subjects[subs[i][0]]=''
            
        for i in range(len(subjects)):
                temp=[]
                for j in range(1,10):
                    query="select count(*) from students_submission_form_details_backup where p"+str(j)+"='"+list(subjects.keys())[i]+"'"
                    cursor=conn.cursor()
                    cursor.execute(query)
                    row=cursor.fetchall()
                    temp.append(row[0][0])
                subjects[list(subjects.keys())[i]]=temp
        conn.close()

        # In[3]:
        a=[]
        for i in subjects.keys():
            # total=subjects[i][0]+subjects[i][1]*0.75+subjects[i][2]*0.50+subjects[i][3]*0.25
            total=subjects[i][0]*9+subjects[i][1]*8+subjects[i][2]*7+subjects[i][3]*6+subjects[i][4]*5+subjects[i][5]*4+subjects[i][6]*3+subjects[i][7]*2+subjects[i][8]*1;
            subjects[i]=total
            temp=[]
            temp.append(subjects[i])
            temp.append(i)
            a.append(temp)


        # In[4]:


        df=pd.DataFrame(a)
        df2=df.sort_values(by=[0])


        # In[5]:


        # Plotting the graph
        sns.set(style="white", context="talk")

        # Set up the matplotlib figure
        f,ax1= plt.subplots(1, 1, figsize=(15, 7), sharex=True)

        # Generate some sequential data
        x1= np.array(list(subjects.keys()))
        y1=np.array(list(df2[0]))


        # Randomly reorder the data to make it qualitative
        sns.barplot(x=x1, y=y1, palette="deep", ax=ax1)
        image=sns.barplot(x=x1, y=y1,palette="deep", ax=ax1)
        ax1.axhline(0, color="k", clip_on=False)
        ax1.set_xlabel("Subjects",labelpad=25)
        ax1.set_ylabel("Demand",labelpad=15)

        # Finalize the plot
        sns.despine(top=True, right=True, bottom=True, offset=True, trim=False)
        plt.tight_layout(h_pad=2)

        #saving the image to a specific path
        image.figure.savefig("C:/xampp/htdocs/FOE/DashBoard/"+db_name+".png")
        return("Success")
    except:
        return("Failed")
    

@app.route('/Subjects_Excel_File_Format_Checking')
def Subjects_File_Format_Checking():
    # In[2]:
    #load an excel file
    xl1=pd.ExcelFile('C:/xampp/htdocs/FOE/common/Flask/Excel File/subjects_data.xlsx')
    xl2=pd.ExcelFile("C:/xampp/htdocs/FOE/common/Flask/Excel File/File Formats/Subjects_File_Format.xlsx")

    # In[3]:
    #Know no of Sheets
    sheet_names1=xl1.sheet_names
    sheet_names2=xl2.sheet_names

    # In[4]:
    #Find No. of Sheets
    length=len(xl1.sheet_names)

    # In[5]:
    sheet_passed=0
    for i in range(1,length+1):
        count=0
        df1=xl1.parse(sheet_names1[i-1])
        df2=xl2.parse(sheet_names2[i-1])
        if(len(df1)>7):
            for j in range(len(df2.columns)):
                if(df1.columns[j].lower().strip()==df2.columns[j].lower().strip()):
                    count+=1
            if(count==len(df2.columns)):
                sheet_passed+=1

        else:
            return redirect("http://localhost/FOE/common/Flask/templates/error.php?msg=No such Data Found, Recheck the File...!!")
    

    if(sheet_passed==3):
        return render_template('subjects_insertion.html')
    else:
        return redirect("http://localhost/FOE/common/Flask/templates/error.php?msg=Excel File Format Failed to Match")




@app.route('/Subjects')
def subjects():
    # In[2]:
    #load an excel file
    xl=pd.ExcelFile("C:/xampp/htdocs/FOE/common/Flask/Excel File/subjects_data.xlsx")


    # In[3]:
    #find the sheet names
    sheet_names=xl.sheet_names

    # In[4]:
    #finding the no of sheets
    # length=len(sheet_names)


    # In[6]:
    try:
        conn=mysql.connector.connect(host="localhost",user="root",password="",database="openelective")
        cursor=conn.cursor()
        for i in sheet_names:
            query1='insert into `'+i+"` values "
            query2="insert into track_no_of_seats values"
            df=xl.parse(i)
            df.dropna()
            df=df.values
            for j in df:
                query1+=(str(tuple(j))+",")
                temp=np.append(j,j[-3])
                query2+=(str(tuple(temp))+",")

            #transformation to final query 
            query1=query1[:-1]
            query2=query2[:-1]
        #     print(query+"\n\n")

            #truncate the table name with 'i' --->oe database
            cursor.execute("TRUNCATE table `"+i+"`")
            conn.commit()
            
            #inserting subjects data into table ---> oe database
            cursor.execute(query1)
            conn.commit()

            #########################################################################################
            #inserting the subjects details into track_no_of_seats table in respective semesters
            conn_track=mysql.connector.connect(host="localhost",user="root",password="",database=i)
            cursor_track=conn_track.cursor();
            
            #truncate the table name with 'i' --->respective database
            cursor_track.execute("TRUNCATE table track_no_of_seats")
            conn_track.commit()
            
            # #inserting subjects data into table --->respective database
            cursor_track.execute(query2)
            conn_track.commit()

            conn_track.close()
            #########################################################################################

        conn.close()
        return redirect("http://localhost/FOE/common/Flask/templates/exit.php?msg=Subjects are Modified Successfully")

    except:
        return redirect("http://localhost/FOE/common/Flask/templates/error.php?msg=Error while inserting subjects data Contact Admin")


@app.route('/Manual_Excel_File_Format_Checking')
def Manual_Excel_File_Format_Checking():

    #load an Excel File
    xl1=pd.ExcelFile("C:/xampp/htdocs/FOE/common/Flask/Excel File/File Formats/Manual_File_Format.xlsx")
    xl2=pd.ExcelFile("C:/xampp/htdocs/FOE/common/Flask/Excel File/manual_data.xlsx")
    
    #find the sheet_names
    sheet_names=xl1.sheet_names

    sheets_passed=0
    for i in sheet_names:
        count=0
        df1=xl2.parse(i)
        df2=xl2.parse(i)
        for j in range(len(df1.columns)):
            if(df1.columns[j].lower().strip()==df2.columns[j].lower().strip()):
                count+=1
        if(count==len(df1.columns)):
            sheets_passed+=1
    if(sheets_passed==3):
        return render_template("manual_data_insertion.html")
    else:
        return redirect("http://localhost/FOE/common/Flask/templates/error.php?msg=Excel File Format Failed to Match")

@app.route('/Manual_Process')
def Manual_Process():
    sheet_names=['iii-i','iii-ii','iv-i']
    df1=""
    df2=""
    try:
        for i in sheet_names:
            #establish database connection
            conn=mysql.connector.connect(host="localhost",user="root",password="",database=i)
            cursor=conn.cursor()

            #Checking whether allotment of seats process completed or not...!!
            check_result=cursor.execute("select * from alloted_student_details")
            check_records=list(map(list,cursor.fetchall()))

            if(len(check_records)>0):
                pass
            else:
                continue

            #########################################################################################
                                            #retriving data from database
            cursor.execute("select * from students_submission_form_details")
            df1=list(map(list,cursor.fetchall()))

            A=np.array(df1)
            A=set(A[:,0])
            #########################################################################################
                                            #read data from excel file
            xl=pd.ExcelFile("C:/xampp/htdocs/FOE/common/flask/Excel File/manual_data.xlsx")
            df2=xl.parse(i)
            df2=df2.dropna()
            data=df2.values.tolist()
            df2=np.array(df2[:].values)
            nicknames=set(df2[:,8])
            
            B=set(df2[:,0])

            sub_replace={}
            available={}
            query2="select nickname,subject_name,available from track_no_of_seats where "
            for j in nicknames:
                query2+="nickname='"+j+"' or "
            query2=query2[:-4]
            cursor.execute(query2)

            Extract_sub_names=list(map(list,cursor.fetchall()))

            for j in Extract_sub_names:
                sub_replace[j[0]]=j[1]
                available[j[0]]=j[2]
        #     print(sub_replace)

            manual_data={}
            for j in range(len(df2)):
                manual_data[df2[j,0]]=df2[j,8]
        #     print(manual_data)

            if(len(A-B)==0):
                query="insert into alloted_student_details values"
                sql_data={}
                for j in data:
                    sql_data[j[0]]=j[:]
        #             sql_data[j[0]][4]=str(sub_replace[manual_data[j[0]]])
        #             sql_data[j[0]].insert(3,str(sub_replace[manual_data[j[0]]]))
        #             print(str(tuple(sql_data[j[0]])))
                    query+=str(tuple(sql_data[j[0]]))+","
                query=query[:-1]
        #         print(query)
        #     print("######################################")


                ######################################################################################################################################################################################################
                    #A-retriving the details of unalloted students
                    #B-read data(details of unalloted students) from each sheet
                    #C=B-A ---> extra records if present 
                    #before executing the query check if there is any manipulation incase needed, sp for that check if there are any extra records in 'B' i.e(uploaded file) then 
                        # if len(B-A) it means that allocation of seats were not completely successfull, so delete these extra records from allocation which are specified in excel file for manipulation 
                        #Since these extra records are specified in excel file entry all those to database so that alloted and manual process is completed.

                C=tuple(B-A)
                if(len(C)>0):
                    cursor.execute("delete from alloted_student_details where rollno in "+str(C))           
        #             cursor.commit()
                ######################################################################################################################################################################################################

                #execute the query
                cursor.execute(query)
                conn.commit()

                #truncate data from the student_submission_form_details table
                query="TRUNCATE table students_submission_form_details"
                cursor.execute(query)
                conn.commit()

                #update track_no_of_seats table

                seats_in_need=pd.DataFrame.from_records(df2)[8].value_counts()
        #         y=x[8].value_counts()
        #         print(seats_in_need)
        #         print(y.index.values)

                for k in sub_replace.keys():
                    query="update track_no_of_seats set available="+str(available[k]-seats_in_need[k])+" where nickname='"+k+"'"
                    cursor.execute(query)
                    conn.commit()
                
            #close database connection
            conn.close()
            
    except:
        return redirect("http://localhost/FOE/common/Flask/templates/error.php?msg=Manual Process Failed")
    finally:
        return redirect("http://localhost/FOE/common/Flask/templates/exit.php?msg=Manual Process Completed Successfully")

if __name__ == '__main__':
    app.secret_key='secret123'
    app.run(debug=True)