import http
import cv2
import numpy as np
import face_recognition
import os
import urllib3
import requests
import json
from urllib.parse import urlparse
from datetime import  datetime
path = 'ImageBasic'


def sending(sid,cid):
    data = {
        "sid": sid,
        "cid": cid,
        "marked": "1",
    }
    r = http.request("POST", "http://localhost/pra/attendance.php", fields=data)
    if r.status == 200:
        print(r.data)
        print("Successfull")
url="http://localhost/pra/getinfo.php"
http = urllib3.PoolManager()
resp = http.request("GET", url)

result = resp.json()
img_list = []
for i in result:
    for j in i:
        img = i['profilephoto']
        img_list.append("http://localhost/pra/profilephoto/"+img)
print(img_list)

def download_file(url):
    # Parse the URL to extract the filename
    parsed_url = urlparse(url)
    filename = parsed_url.path.split("/")[-1]
    print(filename)

    # Send a GET request to the URL
    response = requests.get(url)

    # Check if the request was successful
    if response.status_code == 200:
        # Write the contents of the response to a file
        with open("ImageBasic/"+filename, 'wb') as file:
            file.write(response.content)
        print(f"File downloaded as {filename}")
    else:
        print(f"Failed to download file from {url}")


for i in img_list:
    download_file(i)

images = []
classNames = []
myList = os.listdir(path)
print(myList)
for cl in myList:
    curImg = cv2.imread(f'{path}/{cl}')
    images.append(curImg)
    classNames.append(os.path.splitext(cl)[0])
print(classNames)
def findEncodings(images):
    encodeList = []
    for img in images:
        img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        encode = face_recognition.face_encodings(img)[0]
        encodeList.append(encode)
    return  encodeList
encodeListKnown = findEncodings(images)
print("Encoding Complete")
def markAttendance(sid,cid):
        nameList = []
        for line in myDataList:
            entry = line.split(',')
            nameList.append(entry[0])
        if sid not in nameList:
            sending(sid, cid)


cap = cv2.VideoCapture(0)
while True:
    success,img = cap.read()
    imgS = cv2.resize(img,(0,0),None,0.25,0.25)
    imgS = cv2.cvtColor(imgS, cv2.COLOR_BGR2RGB)

    facesCurFrame = face_recognition.face_locations(imgS)
    encodesCurFrame = face_recognition.face_encodings(imgS,facesCurFrame)

    for encodeFace,faceLoc in zip(encodesCurFrame,facesCurFrame):
        matches = face_recognition.compare_faces(encodeListKnown,encodeFace)
        faceDis = face_recognition.face_distance(encodeListKnown,encodeFace)
        matchIndex = np.argmin(faceDis)
        if matches[matchIndex]:
            name = classNames[matchIndex].upper()
            print(name)
            y1,x2,y2,x1 = faceLoc
            y1,x2,y2,x1 = y1*4,x2*4,y2*4,x1*4
            cv2.rectangle(img,(x1,y1),(x2,y2),(0,255,0),2)
            cv2.rectangle(img, (x1, y2-35), (x2, y2), (0, 255, 0),cv2.FILLED)
            cv2.putText(img,name,(x1+6,y2-6),cv2.FONT_HERSHEY_COMPLEX,1,(255,255,255),2)
            markAttendance(name,cid='def')

    cv2.imshow('Webcam',img)
    cv2.waitKey(1)
